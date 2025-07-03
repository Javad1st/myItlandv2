<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!file_exists('./database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}

require_once './database/db.php';

$error = '';
$success = '';
$expires_at = null;

if (!isset($_GET['email']) || empty($_GET['email']) || !isset($_SESSION['registration']) || $_SESSION['registration']['email'] !== $_GET['email']) {
    $error = 'ایمیل معتبر نیست یا جلسه ثبت‌نام نامعتبر است. لطفاً <a href="register.php">دوباره ثبت‌نام کنید</a>.';
    unset($_SESSION['registration']);
} else {
    $email = filter_var(trim($_GET['email']), FILTER_SANITIZE_EMAIL);
    $expires_at = $_SESSION['registration']['expires_at'] ?? null;

    // بررسی انقضا
    if ($expires_at && time() > $expires_at) {
        $error = 'کد تأیید منقضی شده است. لطفاً <a href="register.php">دوباره ثبت‌نام کنید</a>.';
        unset($_SESSION['registration']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $code = trim($_POST['code']);

    if (empty($code) || !is_numeric($code) || strlen($code) != 6) {
        $error = 'کد تأیید باید ۶ رقمی باشد.';
    } else {
        try {
            if (!$conn instanceof PDO) {
                throw new Exception('اتصال دیتابیس ($conn) معتبر نیست.');
            }

            // بررسی کد تأیید
            if (isset($_SESSION['registration']) && $_SESSION['registration']['verification_code'] == $code) {
                // بررسی انقضا
                if (time() > $_SESSION['registration']['expires_at']) {
                    $error = 'کد تأیید منقضی شده است. لطفاً <a href="register.php">دوباره ثبت‌نام کنید</a>.';
                    unset($_SESSION['registration']);
                } else {
                    // ثبت کاربر در جدول users
                    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                    if (!$stmt) {
                        throw new Exception('خطا در آماده‌سازی کوئری کاربران: ' . implode(' ', $conn->errorInfo()));
                    }
                    $stmt->execute([
                        ':email' => $_SESSION['registration']['email'],
                        ':password' => $_SESSION['registration']['password']
                    ]);

                    $success = 'حساب شما با موفقیت تأیید شد! اکنون می‌توانید وارد شوید.';
                    unset($_SESSION['registration']);
                    header("Refresh: 2; url=login.php");
                }
            } else {
                $error = 'کد تأیید اشتباه است.';
            }
        } catch (Exception $e) {
            $error = 'خطا در ارتباط با دیتابیس: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید کد | وب‌سایت حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css">
    <style>
        body {
            font-family: 'Vazir', Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 500;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            background: #f9f9f9;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 8px rgba(26, 115, 232, 0.3);
            outline: none;
        }
        .input-group label {
            position: absolute;
            top: 12px;
            right: 12px;
            color: #666;
            font-size: 14px;
            transition: all 0.3s;
            pointer-events: none;
        }
        input:focus + label, input:not(:placeholder-shown) + label {
            top: -20px;
            font-size: 12px;
            color: #1a73e8;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        button:hover {
            background: #1557b0;
            transform: translateY(-2px);
        }
        button:disabled {
            background: #999;
            cursor: not-allowed;
            transform: none;
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
        .timer {
            color:rgb(26, 200, 73);
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            background: #e8f0fe;
            padding: 10px;
            border-radius: 5px;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
        .link a {
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
        }
        .link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .form-container {
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
    <div class="form-container">
        <h2>تأیید کد</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php else: ?>
            <p class="timer" id="timer">در حال محاسبه زمان باقی‌مانده...</p>
        <?php endif; ?>
        <form method="POST" id="verifyForm">
            <div class="input-group">
                <input type="text" name="code" id="code" placeholder=" " required>
                <label for="code">کد تأیید</label>
            </div>
            <button type="submit" id="submitButton" class="btn">تأیید</button>
        </form>
        <div class="link">
            <p>بازگشت به <a href="register.php">ثبت‌نام</a> یا <a href="login.php">ورود</a></p>
        </div>
    </div>

    <script>
        const expiresAt = <?php echo $expires_at ? json_encode($expires_at * 1000) : 'null'; ?>;
        const submitButton = document.getElementById('submitButton');
        const verifyForm = document.getElementById('verifyForm');
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            if (!expiresAt) {
                timerElement.textContent = 'زمان تأیید نامشخص است.';
                submitButton.disabled = true;
                verifyForm.style.pointerEvents = 'none';
                return;
            }

            const now = Date.now();
            const diffMs = expiresAt - now;

            if (diffMs <= 0) {
                timerElement.textContent = 'کد تأیید منقضی شده است.';
                timerElement.className = 'error';
                submitButton.disabled = true;
                verifyForm.style.pointerEvents = 'none';
                return;
            }

            const minutes = Math.floor(diffMs / 60000);
            const seconds = Math.floor((diffMs % 60000) / 1000);
            timerElement.textContent = `${minutes} دقیقه و ${seconds} ثانیه باقی‌مانده`;
        }

        if (expiresAt) {
            updateTimer();
            setInterval(updateTimer, 1000);
        }
    </script>
</body>
</html>