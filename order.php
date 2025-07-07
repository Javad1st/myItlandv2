<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log session for debugging
file_put_contents('debug.log', "Session at start of order.php: " . print_r($_SESSION, true) . "\n", FILE_APPEND);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    file_put_contents('debug.log', "Redirecting to login.php: user_id not set\n", FILE_APPEND);
    header("Location: login.php");
    exit;
}

// Database connection
if (!file_exists('database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}
require_once 'database/db.php';

// Include PHPMailer via Composer autoloader
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$confirmation = null;
$error = null;

try {
    if (!isset($conn) || !$conn instanceof PDO) {
        throw new Exception('اتصال دیتابیس ($conn) معتبر نیست.');
    }

    // Set PDO attributes for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user data to prefill form
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Log query result
    file_put_contents('debug.log', "User query result: " . print_r($user, true) . "\n", FILE_APPEND);

    if (!$user) {
        file_put_contents('debug.log', "Redirecting to login.php: user not found for user_id {$_SESSION['user_id']}\n", FILE_APPEND);
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name         = trim($_POST['name'] ?? '');
        $email        = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $phone        = trim($_POST['phone'] ?? '');
        $project_type = trim($_POST['project-type'] ?? '');
        $details      = trim($_POST['details'] ?? '');
        $budget       = str_replace(',', '', trim($_POST['budget'] ?? ''));
        $days         = trim($_POST['days'] ?? '');
        $user_id      = (int)$_SESSION['user_id'];

        // Validate inputs
        if (empty($name) || empty($email) || empty($phone) || empty($project_type) || empty($details) || empty($budget) || empty($days)) {
            throw new Exception("لطفاً تمام فیلدها را پر کنید.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("لطفاً ایمیل معتبر وارد کنید.");
        }
        if (!preg_match('/^09[0-9]{9}$/', $phone)) {
            throw new Exception("لطفاً شماره تماس معتبر (۱۱ رقم، شروع با ۰۹) وارد کنید.");
        }
        if (!is_numeric($budget) || $budget <= 0) {
            throw new Exception("لطفاً بودجه معتبر (بزرگ‌تر از صفر) وارد کنید.");
        }
        if (!is_numeric($days) || $days <= 0) {
            throw new Exception("لطفاً تعداد روزهای معتبر (بزرگ‌تر از صفر) وارد کنید.");
        }
        if (strlen($project_type) > 100) {
            throw new Exception("نوع پروژه نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.");
        }
        if (strlen($details) > 1000) {
            throw new Exception("جزئیات پروژه نمی‌تواند بیش از ۱۰۰۰ کاراکتر باشد.");
        }

        // Check order limit per day
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ? AND order_date > NOW() - INTERVAL 1 DAY");
        $stmt->execute([$user_id]);
       

        // Calculate deadline date
        $deadline = date('Y-m-d', strtotime("+$days days"));

        // Generate unique 6-digit tracking code and order number
        do {
            $tracking_code = rand(100000, 999999);
            $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE tracking_code = ?");
            $stmt->execute([$tracking_code]);
            $exists = $stmt->fetchColumn();
        } while ($exists);

        do {
            $order_number = 'ORD-' . rand(10000, 99999);
            $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE order_number = ?");
            $stmt->execute([$order_number]);
            $exists = $stmt->fetchColumn();
        } while ($exists);

        // Prepare data for insertion
        $params = [
            ':user_id'      => (int)$user_id,
            ':order_number' => $order_number,
            ':name'         => $name,
            ':email'        => $email,
            ':phone'        => $phone,
            ':project_type' => $project_type,
            ':details'      => $details,
            ':budget'       => (float)$budget,
            ':deadline'     => $deadline,
            ':tracking_code' => (string)$tracking_code,
            ':days'         => (int)$days,
            ':status'       => 'pending'
        ];

        // Log parameters for debugging
        file_put_contents('debug.log', "SQL Parameters: " . print_r($params, true) . "\n", FILE_APPEND);

        // Insert into database
        $query = "INSERT INTO orders (user_id, order_number, name, email, phone, project_type, details, budget, deadline, tracking_code, days, order_date, status) 
                  VALUES (:user_id, :order_number, :name, :email, :phone, :project_type, :details, :budget, :deadline, :tracking_code, :days, NOW(), :status)";
        
        $stmt = $conn->prepare($query);
        if (!$stmt->execute($params)) {
            throw new Exception('خطا در ثبت سفارش در دیتابیس: ' . implode(' ', $stmt->errorInfo()));
        }

        // Store in session for invoice
        unset($_SESSION['last_order']);
        $_SESSION['last_order'] = [
            'user_id'       => $user_id,
            'order_number'  => $order_number,
            'name'          => $name,
            'email'         => $email,
            'phone'         => $phone,
            'project_type'  => $project_type,
            'details'       => $details,
            'budget'        => $budget,
            'deadline'      => $deadline,
            'tracking_code' => $tracking_code,
            'days'          => $days,
            'order_id'      => $conn->lastInsertId()
        ];

        // Send email with PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'myitland.ir@gmail.com';
            $mail->Password = 'tcae fqhb huxl unqh'; // Use an App Password for Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('myitland.ir@gmail.com', 'وبسایت آیتی لند');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'فاکتور سفارش شما';
            $mail->Body = '
            <!DOCTYPE html>
            <html lang="fa">
            <head>
                <meta charset="UTF-8">
                <style>
                    @font-face {
                        font-family: \'Vazir\';
                        src: url(\'https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.woff2\') format(\'woff2\');
                        font-weight: normal;
                        font-style: normal;
                    }
                    body {
                        font-family: \'Vazir\', Arial, sans-serif;
                       
                        color:rgb(21, 21, 21);
                        direction: rtl;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background: rgba(255, 255, 255, 0.1);
                        border-radius: 15px;
                        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
                    }
                    h2 {
                        font-size: 24px;
                        margin-bottom: 20px;
                        text-align: center;
                        color:rgb(98, 255, 95);
                    }
                    .invoice-details {
                        font-size: 16px;
                    }
                    .invoice-details p {
                        background: rgba(255, 255, 255, 0.05);
                        padding: 10px;
                        border-radius: 10px;
                        margin-bottom: 10px;
                    }
                    .invoice-details strong {
                        color:rgb(95, 255, 116);
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        margin-top: 20px;
                        color: #ffffff;
                    }
                    .footer a {
                        color:rgb(95, 255, 156);
                        text-decoration: none;
                    }
                    .footer a:hover {
                        text-decoration: underline;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>جزئیات سفارش شما</h2>
                    <div class="invoice-details">
                        <p><strong>کد رهگیری:</strong> ' . htmlspecialchars($tracking_code) . '</p>
                        <p><strong>شماره سفارش:</strong> ' . htmlspecialchars($order_number) . '</p>
                        <p><strong>نام و نام خانوادگی:</strong> ' . htmlspecialchars($name) . '</p>
                        <p><strong>ایمیل:</strong> ' . htmlspecialchars($email) . '</p>
                        <p><strong>شماره تماس:</strong> ' . htmlspecialchars($phone) . '</p>
                        <p><strong>نوع پروژه:</strong> ' . htmlspecialchars($project_type) . '</p>
                        <p><strong>جزئیات پروژه:</strong> ' . nl2br(htmlspecialchars($details)) . '</p>
                        <p><strong>بودجه تقریبی:</strong> ' . number_format($budget) . ' تومان</p>
                        <p><strong>مهلت تحویل (روز):</strong> ' . htmlspecialchars($days) . ' روز</p>
                        <p><strong>تاریخ سررسید:</strong> ' . htmlspecialchars($deadline) . '</p>
                    </div>
                    <div class="footer">
                        <p>© 2025 طراحی شده توسط وبسایت آیتی لند | <a href="#">شرایط و ضوابط</a></p>
                    </div>
                </div>
            </body>
            </html>';

            $mail->send();
            $confirmation = "سفارش شما با موفقیت ثبت شد! فاکتور به ایمیل شما ارسال شد. به صفحه فاکتور هدایت می‌شوید...";
            header("Refresh:2; url=factor.php");
        } catch (Exception $e) {
            $error = "خطا در ارسال ایمیل: " . htmlspecialchars($e->getMessage());
        }
    }
} catch (Exception $e) {
    $error = "خطا در ثبت سفارش: " . htmlspecialchars($e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارش پروژه</title>
    <style>
       
            @font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bolder;
  src: url(yekan/Yekan-Bakh-FaNum-07-Heavy.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bold;
  src: url(yekan/Yekan-Bakh-FaNum-06-Bold.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 900;
  src: url(yekan/Yekan-Bakh-FaNum-08-Fat.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 700;
  src: url(yekan/Yekan-Bakh-FaNum-05-Medium.woff);
}



@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 300;
  src: url(yekan/Yekan-Bakh-FaNum-04-Regular.woff);
}

        * {
            font-family: iranSans;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            
            background-color: #f5f5f5;
            direction: rtl;
            margin: 0;
            padding: 0;
            overflow-x: hidden!important;
        }

/* افکت گرادیانت متحرک برای header */
@keyframes headerGradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

header {
  background: linear-gradient(270deg, rgb(25, 25, 25), rgb(50, 50, 50));
  background-size: 400% 400%;
  animation: headerGradient 8s ease infinite;
  color: white;
  padding: 20px;
  text-align: center;
  border-bottom: 2px solid rgb(255, 255, 255);
}

h1 {
  font-size: 36px;
  margin: 0;
}

.container {
  width: 80%;
  margin: 30px auto;
}

/* فرم کانتینر با افکت هاور انیمیشنی */
.form-container {
  background-color: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}
.stepsSec{
  display: flex;
  flex-direction: column;
  align-items: center;
}

.steps-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 40px;
  gap: 0px;
  position: relative;
  margin-left: 1rem;
  max-width: 920px;
  width: 100%;
}

.step:first-child {
  border-radius: 0 20px 20px 0;
}
.step:last-child {
  border-radius: 20px 0px 0px 20px;
}

/* افکت پالس برای مرحله فعال */
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(60, 217, 114, 0.7); }
  70% { box-shadow: 0 0 0 10px transparent; }
  100% { box-shadow: 0 0 0 0 rgba(60, 217, 114, 0.7); }
}
.active {
    color: white !important;
  background-color: rgb(13, 224, 115);
  animation: pulse 2s infinite;
}

.step {
  z-index: 1;
  position: relative;
  width: 25%;
  text-align: center;
  padding: 10px;
  font-size: 18px;
  border: 5px solid rgb(38, 40, 40);
  color: rgb(38, 40, 40);
  min-width: 50px;
  transition: background-color 0.3s ease, transform 0.3s ease;
}


.step img {
  position: absolute;
  right: 40%;
  top: -49px;
  width: 45px;
  z-index: 100;
  animation: lampGlow 3s ease-in-out infinite alternate;
}
@keyframes lampGlow {
  from { filter: brightness(1); }
  to { filter: brightness(1.2); }
}

.cable {
  position: absolute;
  right: 57%;
  top: -53px;
  height: 50px;
  width: 88%;
  animation: cableSwing 4s ease-in-out infinite;
}
@keyframes cableSwing {
  0% { transform: rotate(0deg); }
  50% { transform: rotate(2deg); }
  100% { transform: rotate(0deg); }
}

#cable1 {
  z-index: 10;
}
#cable2 {
  z-index: 10;
}
#cable3 {
  z-index: 10;
}
.rotCable {
  transform: rotate(180deg);
}

#step1 {
  border-left: unset;
}
#step2 {
  border-left: unset;
  border-right: unset;
}
#step3 {
  border-left: unset;
  border-right: unset;
}
#step4 {
  border-right: unset;
}

@media screen and (max-width:770px) {
    .steps-container{
        margin: 0px -60px;
        margin-top: -45%;
        scale: 0.85;
    }
    .category-box{
        font-size: 13px;
    }
    .category-boxes{
        gap: 0px;
    }
  .step:first-child {
    border-radius: 20px 20px 0 0;
  }
  .step:last-child {
    border-radius: 0 0 20px 20px;
  }
  .form-container {
    flex-direction: row;
  }
  .form-container button {
    font-size: 12px!important;
  }
  .step img {
    position: absolute;
    right: -38px;
    top: 6px;
    transform: rotate(90deg);
    width: 35px;
  }
  .cable {
    display: none;
  }
  .step {
    border: 5px solid rgb(38, 40, 40);
  }
  #step1 {
    border-bottom: unset;
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step2 {
    border-bottom: unset;
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step3 {
    border-bottom: unset;
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step4 {
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
  }
}

.form-container {
  margin-bottom: 20px;
}

.form-container label {
  font-size: 18px;
  color: #333;
  margin-bottom: 8px;
  display: block;
}

.form-container input,
.form-container textarea,
.form-container select {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 5px;
  transition: border-color 0.3s ease;
}
.form-container input:hover,
.form-container textarea:hover,
.form-container select:hover {
  border-color: #3cd972;
}

.form-container input:focus,
.form-container textarea:focus,
.form-container select:focus {
  border-color: #3cd972;
  outline: none;
}

.form-container button {
  background-color: rgb(38, 40, 40);
  color: white;
  padding: 10px 15px;
  font-size: 18px;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  margin-top: 0.4rem;
  transition: background-color 0.3s ease, transform 0.3s ease;
}
.form-container button:hover {
  background-color: #3cd972;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(60, 217, 114, 0.3);
}

.footer {
  background-color: #333;
  color: white;
  text-align: center;
  padding: 15px;
  margin-top: 40px;
}

footer a {
  color: #3cd972;
  text-decoration: none;
  font-weight: bold;
}
footer a:hover {
  text-decoration: underline;
}

/* Mobile responsive design */
@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  header h1 {
    font-size: 28px;
  }
  .steps-container {
    flex-direction: column;
  }
  .category-boxes {
    flex-direction: column;
    gap: -40px;
    scale: 0.8;
    
  }
  .category-box{
    margin: -30px auto;
  }
  #graphCat {
    margin-top: -2rem;
  }
  .form-group label{
    font-size: 16px !important;
  }
}

.category-boxes {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.3rem;
}
.category-box {
  padding: 0.2rem 0.8rem;
  text-align: center;
  background-color: #333;
  border-radius: 12px;
  transition: all 0.2s ease-out;
  font-size: x-large;
  color: #f5f5f5;
  margin-bottom: 2rem;
  cursor: pointer;
}
.category-box:hover {
  transform: translateY(-3px);
}


/* Mobile responsive design */
@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  header h1 {
    font-size: 28px;
  }
  .step-container {
    flex-direction: column;
  }
  .category-boxes {
    flex-direction: column;
  }
  #graphCat {
    margin-top: -2rem;
  }
  #testCat {
    margin-top: -2rem;
  }
}

.category-boxes {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.3rem;
 margin-top: 0.3rem;
}
.category-box {
  padding: 0.2rem 0.8rem;
  text-align: center;
  background-color: #333;
  border-radius: 12px;
  transition: all 0.2s ease-out;
  font-size: x-large;
  color: #f5f5f5;
  margin-bottom: 2rem;
  cursor: pointer;
 
}
.category-box:hover {
  transform: translateY(-3px);
}
.active-cat {
  background-color: #3cd972;
  transform: translateY(-1px);
}

form {
  position: relative;
  min-height: 500px;       /* حداقل ارتفاع فرم */
  padding-bottom: 40px;    /* فضای کافی برای دکمه‌ها */
}

.steps-wrapper {
  overflow: hidden;        /* مخفی کردن مراحل غیرفعال */
  position: relative;
}


/* نمایش مرحله‌ی فعال */


/* استایل ثابت باکس دکمه‌ها */
.formButtons {
  display: flex;
  position: absolute;
  bottom: 100px;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  width: 100%;
  z-index: 10;            
  min-width: 250px;
}

.formButtons button {
  margin: 0 8px;
  padding: 10px 20px;
  cursor: pointer;
}

 .error-text {
            color: #ff4d4d;
            font-size: 0.9rem;
            margin-top: 0.3rem;
            display: none;
        }

          .message {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 10px;
        }
        .confirmation-message {
            color: #ffffff;
            background: #28a745;
        }
        .error-message {
            color: #ffffff;
            background: #dc3545;
        }

         .form-buttons button:disabled {
            background: #555;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>سفارش پروژه</h1>
    </header>

    <div class="container">
        <div class="form-container">
            <?php if (isset($confirmation)): ?>
                <p class="message confirmation-message"><?php echo htmlspecialchars($confirmation); ?></p>
            <?php elseif (isset($error)): ?>
                <p class="message error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <div class="steps-container">
                <div class="step active" id="step1">1
                    <img id="lamp1" src="tasavir/lampOn.png" alt="lamp" width="30px">
                </div>
                <div class="step" id="step2">2
                    <img id="lamp2" src="tasavir/lampOff.png" alt="lamp" width="30px">
                </div>
                <div class="step" id="step3">3
                    <img id="lamp3" src="tasavir/lampOff.png" alt="lamp" width="30px">
                </div>
                <div class="step" id="step4">4
                    <img id="lamp4" src="tasavir/lampOff.png" alt="lamp" width="30px">
                </div>
            </div>

            <form id="projectForm" method="POST">
                <!-- Step 1 -->
                <div id="form-step-1">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">شماره تماس:</label>
                        <input type="text" id="phone" name="phone" required placeholder="09123456789">
                        <span id="phone-error" class="error-text">لطفاً شماره تماس معتبر (۱۱ رقم، شروع با ۰۹) وارد کنید.</span>
                    </div>
                    <div class="form-buttons">
                        <button type="button" id="next-step-1" onclick="nextStep(2)" disabled>مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="form-step-2" style="display: none;">
                    <div class="category-boxes">
                        <div class="category-box active-cat" onclick="selectCategory('web')">وبسایت</div>
                        <div class="category-box" onclick="selectCategory('graph')">گرافیک</div>
                        <div class="category-box" onclick="selectCategory('test')">تست نفوذ</div>
                    </div>
                    <div id="web-form" class="form-group">
                        <label for="project-type-web">نوع پروژه:</label>
                        <select id="project-type-web" name="project-type" required>
                            <option value="">انتخاب نشده</option>
                            <option value="website">وبسایت</option>
                            <option value="ecommerce">فروشگاه اینترنتی</option>
                            <option value="webapp">وب اپلیکیشن</option>
                            <option value="other">سایر...</option>
                        </select>
                    </div>
                    <div id="graph-form" class="form-group" style="display: none;">
                        <label for="project-type-graph">نوع پروژه:</label>
                        <select id="project-type-graph" name="project-type" required disabled>
                            <option value="">انتخاب نشده</option>
                            <option value="poster">پوستر</option>
                            <option value="banner">بنر</option>
                            <option value="social">سوشال مدیا</option>
                            <option value="motion">موشن گرافیک</option>
                            <option value="other">سایر...</option>
                        </select>
                    </div>
                    <div id="test-form" class="form-group" style="display: none;">
                        <label for="project-type-test">نوع پروژه:</label>
                        <select id="project-type-test" name="project-type" required disabled>
                            <option value="">انتخاب نشده</option>
                            <option value="test">تست</option>
                            <option value="penetration">نفوذ</option>
                            <option value="security">امنیت</option>
                            <option value="other">سایر...</option>
                        </select>
                    </div>
                    <div class="form-buttons">
                        <button type="button" onclick="nextStep(1)">بازگشت</button>
                        <button type="button" id="next-step-2" onclick="nextStep(3)" disabled>مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="form-step-3" style="display: none;">
                    <div class="form-group">
                        <label for="details">جزئیات پروژه:</label>
                        <textarea id="details" name="details" rows="5" required></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="button" onclick="nextStep(2)">بازگشت</button>
                        <button type="button" id="next-step-3" onclick="nextStep(4)" disabled>مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="form-step-4" style="display: none;">
                    <div class="form-group">
                        <label for="budget">بودجه تقریبی (تومان):</label>
                        <input type="text" id="budget" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="days">تا چند روز دیگر نیاز دارید؟</label>
                        <input type="number" id="days" name="days" min="1" required>
                    </div>
                    <div class="form-buttons">
                        <button type="button" onclick="nextStep(3)">بازگشت</button>
                        <button type="submit" id="submit-button" disabled>ارسال سفارش</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2025 طراحی شده توسط وبسایت آیتی لند | <a href="#">شرایط و ضوابط</a></p>
    </footer>

    <script>
        let currentCategory = 'web';
        let phoneAttempts = 0;
        const maxPhoneAttempts = 3;
        const steps = document.querySelectorAll('[id^="form-step-"]');
        const stepIndicators = document.querySelectorAll('.step');
        const lamps = document.querySelectorAll('.step img');

        function selectCategory(category) {
            currentCategory = category;
            document.querySelectorAll('.category-box').forEach(box => {
                box.classList.toggle('active-cat', box.textContent === {web: 'وبسایت', graph: 'گرافیک', test: 'تست نفوذ'}[category]);
            });
            document.getElementById('web-form').style.display = category === 'web' ? 'block' : 'none';
            document.getElementById('graph-form').style.display = category === 'graph' ? 'block' : 'none';
            document.getElementById('test-form').style.display = category === 'test' ? 'block' : 'none';
            document.getElementById('project-type-web').disabled = category !== 'web';
            document.getElementById('project-type-graph').disabled = category !== 'graph';
            document.getElementById('project-type-test').disabled = category !== 'test';
            checkStep2();
        }

        function nextStep(stepNumber) {
            if (stepNumber === 2) {
                const phone = document.getElementById('phone').value.trim();
                const phoneRegex = /^09[0-9]{9}$/;
                if (!phoneRegex.test(phone)) {
                    phoneAttempts++;
                    let warningMessage = `لطفاً شماره تماس معتبر (۱۱ رقم، شروع با ۰۹) وارد کنید. (تلاش ${phoneAttempts} از ${maxPhoneAttempts})`;
                    if (phoneAttempts >= maxPhoneAttempts) {
                        warningMessage = `شما بیش از حد تلاش کردید! لطفاً شماره تماس معتبر وارد کنید.`;
                    }
                    document.getElementById('phone-error').style.display = 'block';
                    document.getElementById('phone-error').textContent = warningMessage;
                    alert(warningMessage);
                    return;
                }
                document.getElementById('phone-error').style.display = 'none';
                phoneAttempts = 0;
            }
            steps.forEach((step, index) => {
                step.style.display = index === stepNumber - 1 ? 'block' : 'none';
                stepIndicators[index].classList.toggle('active', index === stepNumber - 1);
                lamps[index].src = index === stepNumber - 1 ? 'tasavir/lampOn.png' : 'tasavir/lampOff.png';
            });
            if (stepNumber === 1) checkStep1();
            if (stepNumber === 2) checkStep2();
            if (stepNumber === 3) checkStep3();
            if (stepNumber === 4) checkStep4();
        }

        function checkStep1() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const nextButton = document.getElementById('next-step-1');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            nextButton.disabled = !(name && email && emailRegex.test(email) && phone);
        }

        function checkStep2() {
            const projectType = document.getElementById(`project-type-${currentCategory}`).value;
            const nextButton = document.getElementById('next-step-2');
            nextButton.disabled = !projectType;
        }

        function checkStep3() {
            const details = document.getElementById('details').value.trim();
            const nextButton = document.getElementById('next-step-3');
            nextButton.disabled = !details;
        }

        function checkStep4() {
            const budget = document.getElementById('budget').value.replace(/,/g, '').trim();
            const days = document.getElementById('days').value.trim();
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = !(budget && Number(budget) > 0 && days && Number(days) > 0);
        }

        const budgetInput = document.getElementById('budget');
        budgetInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/,/g, '');
            if (!isNaN(value) && value !== '') {
                e.target.value = Number(value).toLocaleString('en-US');
            } else {
                e.target.value = '';
            }
            checkStep4();
        });

        document.getElementById('projectForm').addEventListener('submit', function(e) {
            budgetInput.value = budgetInput.value.replace(/,/g, '');
        });

        document.getElementById('name').addEventListener('input', checkStep1);
        document.getElementById('email').addEventListener('input', checkStep1);
        document.getElementById('phone').addEventListener('input', function(e) {
            const phone = e.target.value.trim();
            const phoneRegex = /^09[0-9]{0,9}$/;
            if (phone && !phoneRegex.test(phone)) {
                document.getElementById('phone-error').style.display = 'block';
            } else {
                document.getElementById('phone-error').style.display = 'none';
            }
            checkStep1();
        });
        document.getElementById('project-type-web').addEventListener('change', checkStep2);
        document.getElementById('project-type-graph').addEventListener('change', checkStep2);
        document.getElementById('project-type-test').addEventListener('change', checkStep2);
        document.getElementById('details').addEventListener('input', checkStep3);
        document.getElementById('days').addEventListener('input', checkStep4);

        nextStep(1);
        selectCategory('web');
        checkStep1();
    </script>
</body>
</html>