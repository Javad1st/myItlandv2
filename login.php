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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'لطفاً ایمیل معتبر وارد کنید.';
    } elseif (empty($password)) {
        $error = 'لطفاً رمز عبور را وارد کنید.';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
            if (!$stmt) {
                throw new Exception('خطا در آماده‌سازی کوئری: ' . implode(' ', $conn->errorInfo()));
            }
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // ورود موفق
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];
                $success = 'ورود با موفقیت انجام شد! در حال انتقال...';
                header("Refresh: 2; url=index.php");
            } else {
                $error = 'ایمیل یا رمز عبور اشتباه است.';
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
    <title>ورود | وب‌سایت حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css">
    <style>
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
        <h2>ورود</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">ایمیل</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">رمز عبور</label>
            </div>
            <button type="submit" class="btn">ورود</button>
        </form>
        <div class="link">
            <p>حساب کاربری ندارید؟ <a href="register.php">ثبت‌نام</a></p>
        </div>
    </div>
</body>
</html>