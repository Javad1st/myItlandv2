<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!file_exists('./database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}

require_once './database/db.php';

function sanitize($value) {
    return htmlspecialchars(trim($value));
}

// بررسی ورود کاربر
if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
    $_SESSION['error_message'] = 'لطفاً ابتدا وارد حساب کاربری خود شوید.';
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$order_code = sanitize($_GET['order_code'] ?? '');
$error = '';
$order = null;

if (empty($order_code)) {
    $error = 'کد سفارش نامعتبر است.';
} else {
    try {
        // بازیابی سفارش فقط برای کاربر فعلی
        $stmt = $conn->prepare("SELECT order_code, fullname, user_phone, user_email, user_telegram, package, team_phone, description, created_at 
                                FROM orders2 
                                WHERE order_code = :order_code AND user_id = :user_id");
        $stmt->bindParam(':order_code', $order_code);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            $error = 'سفارش با این کد یافت نشد یا متعلق به شما نیست.';
        }
    } catch (PDOException $e) {
        $error = 'خطا در بازیابی سفارش: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاکتور سفارش | وب‌سایت حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css">
    <style>
        body {
            font-family: 'Vazir', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            direction: rtl;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color:rgb(22, 205, 83);
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 500;
        }
        p {
            font-size: 16px;
            line-height: 1.7;
            color: #333;
        }
        .contact-info {
            margin-top: 30px;
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
        .copy-btn {
            background-color:rgb(0, 9, 3);
            color: white;
            border: none;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s, transform 0.2s;
        }
        .copy-btn:hover {
            background-color:rgb(21, 176, 78);
            transform: translateY(-2px);
        }
        #copyMsg {
            color: #2e7d32;
            font-weight: bold;
        }
        .error {
            color: #d32f2f;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            background: #ffebee;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            color: #2e7d32;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
        }
        @media (max-width: 500px) {
            .container {
                margin: 20px;
                padding: 25px;
            }
        }
          /* متغیرهای اصلی */
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
:root {
  --primary: #28a745;
  --primary-light: #5cd67a;
  --bg-gradient: linear-gradient(135deg,rgb(244, 252, 246) 0%,rgb(227, 227, 227) 100%);
  --font: iranSans;
  --radius: 10px;
  --transition: 0.3s ease-in-out;
}


* {
    font-family: var(--font);
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  background: var(--bg-gradient);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  color: #333;
  padding: 1rem;
}

.form-container {
  background: #fff;
  padding: 2.5rem 2rem;
  border-radius: var(--radius);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  width: 100%;
  max-width: 380px;
  animation: fadeIn 0.6s var(--transition) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-20px); }
  to   { opacity: 1; transform: translateY(0); }
}

h2 {
  text-align: center;
  color: var(--primary);
  margin-bottom: 1.5rem;
  font-size: 1.6rem;
  font-weight: 500;
}

#message {
  text-align: center;
  margin-bottom: 1rem;
  font-size: 0.95rem;
}

/* پیام خطا/موفقیت */
.error {
  color: #c62828;
  background: #ffebee;
  padding: 0.75rem;
  border-radius: var(--radius);
  margin-bottom: 1.6rem;
}

.success {
  color: #2e7d32;
  background: #e8f5e9;
  padding: 0.75rem;
  border-radius: var(--radius);
}

.input-group {
  position: relative;
  margin-bottom: 1.25rem;
}

.input-group input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 2px solid #e0e0e0;
  border-radius: var(--radius);
  font-size: 1rem;
  background: #fafafa;
  transition: border-color var(--transition), box-shadow var(--transition);
}

.input-group input:focus {
  border-color: var(--primary);
  box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
  outline: none;
}

.input-group label {
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  padding: 0 0.25rem;
  color: #777;
  font-size: 0.9rem;
  pointer-events: none;
  transition: top var(--transition), font-size var(--transition), color var(--transition);
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
  top: -0.6rem;
  font-size: 0.75rem;
  color: var(--primary);
}

/* دکمه نمایش/مخفی کردن رمز */
.password-group {
  display: flex;
  align-items: center;
}

.toggle-pass {
  border: none;
  background: transparent;
  font-size: 1.1rem;
  margin-left: -2.5rem;
  cursor: pointer;
  transition: color var(--transition);
}

.toggle-pass:hover {
  color: var(--primary);
}

/* دکمه اصلی */
.btn {
  width: 100%;
  padding: 0.8rem;
  background:rgb(28, 28, 28);
  color: #fff;
  font-size: 1rem;
  font-weight: 500;
  border: none;
  border-radius: var(--radius);
  cursor: pointer;
  transition: background var(--transition), transform 0.2s ease-out;
}

.btn:hover {
  background: var(--primary-light);
  transform: translateY(-2px);
}

/* لینک ثبت‌نام */
.link {
  text-align: center;
  margin-top: 1rem;
  font-size: 0.9rem;
}

.link a {
  color: var(--primary);
  text-decoration: none;
  transition: color var(--transition);
}

.link a:hover {
  color: var(--primary-light);
  text-decoration: underline;
}

/* واکنش‌گرایی */
@media (max-width: 400px) {
  .form-container {
    padding: 2rem 1rem;
  }

  h2 {
    font-size: 1.4rem;
  }

  .btn {
    font-size: 0.95rem;
    padding: 0.7rem;
  }
}
    </style>
</head>
<body>
    <div class="container">
        <h1>فاکتور سفارش شما</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php elseif (isset($_SESSION['success_message'])): ?>
            <p class="success"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></p>
        <?php endif; ?>
        <?php if ($order): ?>
            <p>
                <strong>کد سفارش:</strong> 
                <span id="orderCode"><?php echo htmlspecialchars($order['order_code']); ?></span>
                <button onclick="copyOrderCode()" class="copy-btn">📋 کپی</button>
                <span id="copyMsg" style="display:none;">کپی شد!</span>
            </p>
            <p><strong>نام:</strong> <?php echo htmlspecialchars($order['fullname']); ?></p>
            <p><strong>شماره تماس:</strong> <?php echo htmlspecialchars($order['user_phone']); ?></p>
            <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($order['user_email'] ?: 'وارد نشده'); ?></p>
            <p><strong>تلگرام:</strong> <?php echo htmlspecialchars($order['user_telegram'] ?: 'وارد نشده'); ?></p>
            <p><strong>پکیج انتخابی:</strong> <?php echo htmlspecialchars($order['package']); ?></p>
            <p><strong>توضیحات:</strong> <?php echo htmlspecialchars($order['description'] ?: 'بدون توضیحات'); ?></p>
            <p><strong>تاریخ ثبت:</strong> <?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($order['created_at']))); ?></p>
            <hr>
            <div class="contact-info">
                <p><span>📞 تماس با ما:</span> 09391234567</p>
                <p><span>💬 تلگرام:</span> @WebDesignTeam</p>
                <p><span>💬 ایتا:</span> @WebDesignTeam</p>
            </div>
        <?php endif; ?>
        <div class="footer">
            <p>با تشکر از سفارش شما. <a href="packageOrder.php">بازگشت به صفحه اصلی</a></p>
        </div>
    </div>

    <script>
    function copyOrderCode() {
        const code = document.getElementById("orderCode").innerText;
        navigator.clipboard.writeText(code).then(() => {
            const msg = document.getElementById("copyMsg");
            msg.style.display = "inline";
            setTimeout(() => msg.style.display = "none", 2000);
        });
    }
    </script>
</body>
</html>