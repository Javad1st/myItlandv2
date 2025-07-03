<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!file_exists('./database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}

require_once './database/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';
$section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';

try {
    if (!$conn instanceof PDO) {
        throw new Exception('اتصال دیتابیس ($conn) معتبر نیست.');
    }

    // دریافت اطلاعات کاربر
    $stmt = $conn->prepare("SELECT email, name, is_verified FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // ویرایش پروفایل
    if ($section === 'profile' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'ایمیل وارد شده معتبر نیست.';
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $_SESSION['user_id']]);
            if ($stmt->fetch()) {
                $error = 'این ایمیل قبلاً ثبت شده است.';
            } else {
                $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
                $stmt->execute([$name, $email, $_SESSION['user_id']]);
                $success = 'پروفایل با موفقیت به‌روزرسانی شد.';
                $_SESSION['email'] = $email;
                $user['email'] = $email;
                $user['name'] = $name;
            }
        }
    }

    // تغییر رمز عبور
    if ($section === 'settings' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);

        if (empty($current_password) || empty($new_password)) {
            $error = 'همه فیلدها باید پر شوند.';
        } elseif (strlen($new_password) < 6) {
            $error = 'رمز عبور جدید باید حداقل ۶ کاراکتر باشد.';
        } else {
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $current_user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($current_password, $current_user['password'])) {
                $hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute([$hashed, $_SESSION['user_id']]);
                $success = 'رمز عبور با موفقیت تغییر کرد.';
            } else {
                $error = 'رمز عبور فعلی اشتباه است.';
            }
        }
    }

    // دریافت سفارشات
    if ($section === 'orders') {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $error = 'خطا در ارتباط با دیتابیس: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>داشبورد کاربر</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            max-width: 1200px;
            margin: 30px auto;
            gap: 20px;
        }
        .sidebar {
            width: 250px;
            background: white;
            border-radius: 10px;
            padding: 20px;
        }
        .sidebar ul {
            padding: 0;
            list-style: none;
        }
        .sidebar li a {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            text-decoration: none;
            border-radius: 5px;
            color: #333;
            background: #f5f5f5;
        }
        .sidebar li a.active, .sidebar li a:hover {
            background: #1a73e8;
            color: white;
        }
        .content {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 30px;
        }
        .profile-card {
            background: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        h2 {
            margin-top: 0;
            color: #1a73e8;
        }
        p span {
            font-weight: bold;
            color: #444;
        }
        .error, .success {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
        }
        .error {
            background: #ffebee;
            color: #d32f2f;
        }
        .success {
            background: #e8f5e9;
            color: #2e7d32;
        }
        input, button {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .status-pending { color: orange; }
        .status-completed { color: green; }
        .status-cancelled { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="?section=dashboard" class="<?= $section === 'dashboard' ? 'active' : '' ?>">داشبورد</a></li>
                <li><a href="?section=profile" class="<?= $section === 'profile' ? 'active' : '' ?>">پروفایل</a></li>
                <li><a href="?section=settings" class="<?= $section === 'settings' ? 'active' : '' ?>">تنظیمات</a></li>
                <li><a href="?section=orders" class="<?= $section === 'orders' ? 'active' : '' ?>">سفارشات</a></li>
                <li><a href="logout.php" onclick="return confirm('خروج از حساب کاربری؟')">خروج</a></li>
            </ul>
        </div>
        <div class="content">
            <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <?php if ($success): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

            <?php if ($section === 'dashboard'): ?>
                <h2>خوش آمدید، <?= htmlspecialchars($user['name'] ?: $user['email']) ?>!</h2>
                <div class="profile-card">
                    <p><span>ایمیل:</span> <?= htmlspecialchars($user['email']) ?></p>
                    <p><span>نام:</span> <?= htmlspecialchars($user['name'] ?: 'تنظیم نشده') ?></p>
                    <p><span>وضعیت تأیید:</span> <?= $user['is_verified'] ? 'تأیید شده' : 'تأیید نشده' ?></p>
                </div>

            <?php elseif ($section === 'profile'): ?>
                <h2>پروفایل</h2>
                <form method="POST">
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="نام">
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="ایمیل" required>
                    <button type="submit">ذخیره</button>
                </form>

            <?php elseif ($section === 'settings'): ?>
                <h2>تغییر رمز عبور</h2>
                <form method="POST">
                    <input type="password" name="current_password" placeholder="رمز فعلی" required>
                    <input type="password" name="new_password" placeholder="رمز جدید" required>
                    <button type="submit">تغییر رمز</button>
                </form>

            <?php elseif ($section === 'orders'): ?>
                <h2>سفارشات من</h2>
                <?php if (empty($orders)): ?>
                    <p>هیچ سفارشی ثبت نشده است.</p>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <div class="profile-card">
                            <p><span>شماره سفارش:</span> <?= htmlspecialchars($order['order_number']) ?></p>
                            <p><span>نام:</span> <?= htmlspecialchars($order['name']) ?></p>
                            <p><span>ایمیل:</span> <?= htmlspecialchars($order['email']) ?></p>
                            <p><span>تلفن:</span> <?= htmlspecialchars($order['phone']) ?></p>
                            <p><span>نوع پروژه:</span> <?= htmlspecialchars($order['project_type']) ?></p>
                            <p><span>بودجه:</span> <?= number_format($order['budget']) ?> تومان</p>
                            <p><span>تعداد روزها:</span> <?= htmlspecialchars($order['days']) ?></p>
                            <p><span>مهلت:</span> <?= htmlspecialchars($order['deadline']) ?></p>
                            <p><span>توضیحات:</span> <?= nl2br(htmlspecialchars($order['details'])) ?></p>
                            <p><span>کد پیگیری:</span> <?= htmlspecialchars($order['tracking_code'] ?: '---') ?></p>
                            <p><span>تاریخ:</span> <?= date('Y-m-d H:i', strtotime($order['order_date'])) ?></p>
                            <p><span>وضعیت:</span>
                                <?php
                                switch ($order['status']) {
                                    case 'pending': echo '<span class="status-pending">در انتظار</span>'; break;
                                    case 'completed': echo '<span class="status-completed">تکمیل شده</span>'; break;
                                    case 'cancelled': echo '<span class="status-cancelled">لغو شده</span>'; break;
                                    default: echo htmlspecialchars($order['status']);
                                }
                                ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
