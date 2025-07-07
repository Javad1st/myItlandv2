<?php
session_start();
require_once './database/db.php';

$error = '';
$success = '';
$max_attempts = 3; // حداکثر تعداد تلاش‌ها

if (!isset($_SESSION['registration']) || !isset($_GET['email'])) {
    $error = 'دسترسی غیرمجاز. لطفاً از صفحه ثبت‌نام شروع کنید.';
    header("Refresh: 2; url=register.php");
    exit();
}

$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

// بررسی وجود ایمیل در دیتابیس برای اطمینان از عدم ثبت قبلی
try {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $error = 'این ایمیل قبلاً ثبت شده است. لطفاً وارد شوید.';
        unset($_SESSION['registration']);
        header("Refresh: 2; url=login.php");
        exit();
    }
} catch (Exception $e) {
    $error = 'خطا در بررسی ایمیل: ' . $e->getMessage();
    header("Refresh: 2; url=register.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['code']);

    if (empty($code) || !is_numeric($code)) {
        $error = 'لطفاً کد تأیید معتبر وارد کنید.';
    } elseif ($_SESSION['registration']['expires_at'] < time()) {
        $error = 'کد تأیید منقضی شده است. لطفاً دوباره ثبت‌نام کنید.';
        unset($_SESSION['registration']);
        header("Refresh: 2; url=register.php");
        exit();
    } elseif ($_SESSION['registration']['verification_code'] != $code) {
        // افزایش تعداد تلاش‌ها
        $_SESSION['registration']['attempts'] = isset($_SESSION['registration']['attempts']) ? $_SESSION['registration']['attempts'] + 1 : 1;
        $remaining_attempts = $max_attempts - $_SESSION['registration']['attempts'];
        
        if ($remaining_attempts <= 0) {
            $error = 'شما بیش از حد مجاز تلاش کردید. لطفاً دوباره ثبت‌نام کنید.';
            unset($_SESSION['registration']);
            header("Refresh: 2; url=register.php");
            exit();
        } else {
            $error = "کد تأیید نادرست است. تعداد تلاش‌های باقی‌مانده: $remaining_attempts";
        }
    } else {
        // ثبت اطلاعات کاربر در دیتابیس پس از تأیید کد
        try {
            $stmt = $conn->prepare("INSERT INTO users (email, password, name, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([
                $_SESSION['registration']['email'],
                $_SESSION['registration']['password'],
                $_SESSION['registration']['name']
            ]);
            $success = 'ایمیل شما با موفقیت تأیید شد. اکنون می‌توانید وارد شوید.';
            unset($_SESSION['registration']);
            header("Refresh: 2; url=login.php");
            exit();
        } catch (Exception $e) {
            $error = 'خطا در ثبت کاربر: ' . $e->getMessage();
            unset($_SESSION['registration']);
            header("Refresh: 2; url=register.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید ایمیل | وب‌سایت حرفه‌ای</title>
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
        .timer {
            text-align: center;
            font-size: 1rem;
            color: #333;
            margin-bottom: 1rem;
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
        <h2>تأیید ایمیل</h2>
        <div class="timer" id="timer">زمان باقی‌مانده: 02:00</div>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="input-group">
                <input type="text" name="code" id="code" placeholder=" " required>
                <label for="code">کد تأیید</label>
            </div>
            <button type="submit" class="btn">تأیید</button>
        </form>
        <div class="link">
            <p>کد را دریافت نکرده‌اید؟ <a href="register.php">ارسال مجدد</a></p>
        </div>
    </div>

    <script>
        // دریافت زمان انقضا از PHP
        const expiresAt = <?php echo isset($_SESSION['registration']['expires_at']) ? $_SESSION['registration']['expires_at'] : 0; ?>;
        const maxAttempts = <?php echo $max_attempts; ?>;
        let attempts = <?php echo isset($_SESSION['registration']['attempts']) ? $_SESSION['registration']['attempts'] : 0; ?>;

        function startTimer() {
            const timerElement = document.getElementById('timer');
            const now = Math.floor(Date.now() / 1000); // زمان فعلی به ثانیه
            let timeLeft = expiresAt - now;

            if (timeLeft <= 0) {
                timerElement.innerHTML = 'کد منقضی شده است.';
                timerElement.style.color = '#c62828';
                setTimeout(() => {
                    window.location.href = 'register.php';
                }, 2000);
                return;
            }

            const updateTimer = () => {
                timeLeft--;
                if (timeLeft <= 0) {
                    timerElement.innerHTML = 'کد منقضی شده است.';
                    timerElement.style.color = '#c62828';
                    setTimeout(() => {
                        window.location.href = 'register.php';
                    }, 2000);
                    return;
                }

                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.innerHTML = `زمان باقی‌مانده: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            };

            updateTimer();
            setInterval(updateTimer, 1000);
        }

        window.onload = startTimer;
    </script>
</body>
</html>