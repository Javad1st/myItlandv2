<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
require_once 'database/db.php';

// Include PHPMailer via Composer autoloader
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$confirmation = null;
$error = null;
$phone_error = null;

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name         = trim($_POST['name']);
        $email        = trim($_POST['email']);
        $phone        = trim($_POST['phone']);
        $project_type = trim($_POST['project-type']);
        $details      = trim($_POST['details']);
        $budget       = str_replace(',', '', trim($_POST['budget']));
        $days         = trim($_POST['days']);
        $user_id      = $_SESSION['user_id'];

        // Validate phone number (must be 11 digits, start with 09)
        if (!preg_match('/^09[0-9]{9}$/', $phone)) {
            throw new Exception("لطفاً شماره تماس معتبر (۱۱ رقم، شروع با ۰۹) وارد کنید.");
        }

        // Validate days
        if (!is_numeric($days) || $days <= 0) {
            throw new Exception("لطفاً تعداد روزهای معتبر (بزرگ‌تر از صفر) وارد کنید.");
        }

        // Calculate deadline date
        $deadline = date('Y-m-d', strtotime("+$days days"));

        // Generate unique 6-digit tracking code
        do {
            $tracking_code = rand(100000, 999999);
            $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE tracking_code = :tracking_code");
            $stmt->execute([':tracking_code' => $tracking_code]);
            $exists = $stmt->fetchColumn();
        } while ($exists);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, phone, project_type, details, budget, deadline, tracking_code, days) 
                              VALUES (:user_id, :name, :email, :phone, :project_type, :details, :budget, :deadline, :tracking_code, :days)");
        $stmt->execute([
            ':user_id'      => $user_id,
            ':name'         => $name,
            ':email'        => $email,
            ':phone'        => $phone,
            ':project_type' => $project_type,
            ':details'      => $details,
            ':budget'       => $budget,
            ':deadline'     => $deadline,
            ':tracking_code' => $tracking_code,
            ':days'         => $days
        ]);

        // Store in session for invoice
        $_SESSION['last_order'] = [
            'user_id'       => $user_id,
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
            $mail->Password = 'tcae fqhb huxl unqh';
            $mail->SMTPSecure = 'tls';
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
                        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
                        color: #ffffff;
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
                        color: #ff7e5f;
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
                        color: #ff7e5f;
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        margin-top: 20px;
                        color: #ffffff;
                    }
                    .footer a {
                        color: #ff7e5f;
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
                        <p><strong>نام و نام خانوادگی:</strong> ' . htmlspecialchars($name) . '</p>
                        <p><strong>ایمیل:</strong> ' . htmlspecialchars($email) . '</p>
                        <p><strong>شماره تماس:</strong> ' . htmlspecialchars($phone) . '</p>
                        <p><strong>نوع پروژه:</strong> ' . htmlspecialchars($project_type) . '</p>
                        <p><strong>جزئیات پروژه:</strong> ' . htmlspecialchars($details) . '</p>
                        <p><strong>بودجه تقریبی:</strong> ' . number_format($budget) . ' تومان</p>
                        <p><strong>مهلت تحویل (روز):</strong> ' . htmlspecialchars($days) . ' روز</p>
                    </div>
                    <div class="footer">
                        <p>© 2025 طراحی شده توسط وبسایت آیتی لند | <a href="#">شرایط و ضوابط</a></p>
                    </div>
                </div>
            </body>
            </html>';

            $mail->send();
        } catch (Exception $e) {
            $error = "خطا در ارسال ایمیل: " . $mail->ErrorInfo;
        }

        // Set confirmation message
        $confirmation = "سفارش شما با موفقیت ثبت شد! فاکتور به ایمیل شما ارسال شد. به صفحه فاکتور هدایت می‌شوید...";
        
        // Redirect to factor.php after 2 seconds
        header("Refresh:2; url=factor.php");
    }
} catch (Exception $e) {
    $error = "خطا در ثبت سفارش: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارش پروژه</title>
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazir', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            color: #ffffff;
            direction: rtl;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .steps-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .step {
            width: 50px;
            height: 50px;
            background: #2c2c54;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .step.active {
            background: #ff7e5f;
            transform: scale(1.15);
            box-shadow: 0 0 12px rgba(255, 126, 95, 0.7);
        }

        .step img {
            position: absolute;
            top: -35px;
            width: 30px;
            transition: opacity 0.3s ease;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1.1rem;
            color: #ffffff;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-group select option {
            background: #2c2c54;
            color: #ffffff;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px rgba(255, 126, 95, 0.5);
        }

        .error-text {
            color: #ff4d4d;
            font-size: 0.9rem;
            margin-top: 0.3rem;
            display: none;
        }

        .category-boxes {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .category-box {
            padding: 0.8rem 1.5rem;
            background: #2c2c54;
            border-radius: 10px;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .category-box.active {
            background: #ff7e5f;
            transform: translateY(-2px);
        }

        .category-box:hover {
            background: #feb47b;
            transform: translateY(-2px);
        }

        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .form-buttons button {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            background: #ff7e5f;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-buttons button:disabled {
            background: #555;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .form-buttons button:hover:not(:disabled) {
            background: #feb47b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .message {
            text-align: center;
            margin-bottom: 1rem;
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

        footer {
            background: #0f0c29;
            padding: 1.5rem;
            text-align: center;
            color: #ffffff;
        }

        footer a {
            color: #ff7e5f;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }

            .container {
                width: 95%;
            }

            .steps-container {
                flex-direction: column;
                align-items: center;
            }

            .step {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .category-boxes {
                flex-direction: column;
            }
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
                <p class="message confirmation-message"><?php echo $confirmation; ?></p>
            <?php elseif (isset($error)): ?>
                <p class="message error-message"><?php echo $error; ?></p>
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
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" required>
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
                        <div class="category-box active" onclick="selectCategory('web')">وبسایت</div>
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
                box.classList.toggle('active', box.textContent === {web: 'وبسایت', graph: 'گرافیک', test: 'تست نفوذ'}[category]);
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
            nextButton.disabled = !(name && email && phone);
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
            const budget = document.getElementById('budget').value.trim();
            const days = document.getElementById('days').value.trim();
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = !(budget && days && Number(days) > 0);
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