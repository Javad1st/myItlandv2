<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!file_exists('./database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}

require_once './database/db.php';
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'لطفاً ایمیل معتبر وارد کنید.';
    } elseif (empty($password) || strlen($password) < 6) {
        $error = 'رمز عبور باید حداقل ۶ کاراکتر باشد.';
    } elseif (empty($name)) {
        $error = 'لطفاً نام خود را وارد کنید.';
    } else {
        try {
            // بررسی وجود ایمیل در دیتابیس
            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception('این ایمیل قبلاً ثبت شده است.');
            }

            $verification_code = rand(100000, 999999);
            $expires_at = time() + 120; // 2 دقیقه
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // ذخیره اطلاعات در سشن به جای دیتابیس
            $_SESSION['registration'] = [
                'email' => $email,
                'password' => $hashed_password,
                'name' => $name,
                'verification_code' => $verification_code,
                'expires_at' => $expires_at,
                'attempts' => 0 // تعداد تلاش‌های ناموفق
            ];

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
                $mail->Subject = 'کد تأیید ثبت‌نام';
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
                            background: #f4f4f4;
                            color: #333;
                            direction: rtl;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            padding: 20px;
                            background: white;
                            border-radius: 10px;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                        }
                        h2 {
                            color: #1a73e8;
                            text-align: center;
                        }
                        p {
                            font-size: 16px;
                            line-height: 1.5;
                            text-align: center;
                        }
                        .code {
                            font-size: 24px;
                            font-weight: bold;
                            color: #1a73e8;
                            text-align: center;
                            margin: 20px 0;
                        }
                        .footer {
                            text-align: center;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2>کد تأیید ثبت‌نام</h2>
                        <p>لطفاً از کد زیر برای تأیید ایمیل خود استفاده کنید:</p>
                        <p class="code">' . htmlspecialchars($verification_code) . '</p>
                        <p>این کد تا ۲ دقیقه معتبر است.</p>
                        <div class="footer">
                            <p>© 2025 وبسایت آیتی لند</p>
                        </div>
                    </div>
                </body>
                </html>';

                $mail->send();
                $success = 'کد تأیید به ایمیل شما ارسال شد. لطفاً کد را در صفحه تأیید وارد کنید.';
                header("Refresh: 2; url=verify.php?email=" . urlencode($email));
                exit();
            } catch (Exception $e) {
                $error = 'خطا در ارسال ایمیل: ' . $mail->ErrorInfo;
                unset($_SESSION['registration']);
            }
        } catch (Exception $e) {
            $error = 'خطا در ثبت‌نام: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام | وب‌سایت حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css">
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
        :root {
            --primary: #28a745;
            --primary-light: #5cd67a;
            --bg-gradient: linear-gradient(135deg, rgb(232, 237, 233) 0%, rgb(255, 255, 255) 100%);
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
            to { opacity: 1; transform: translateY(0); }
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
        .btn {
            width: 100%;
            padding: 0.8rem;
            background: rgb(28, 28, 28);
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
        <h2>ثبت‌نام</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="input-group">
                <input type="text" name="name" id="name" placeholder=" " required>
                <label for="name">نام</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">ایمیل</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">رمز عبور</label>
            </div>
            <button type="submit" class="btn">ثبت‌نام</button>
        </form>
        <div class="link">
            <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="login.php">ورود</a></p>
        </div>
    </div>
</body>
</html>