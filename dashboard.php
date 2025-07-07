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
$section = isset($_GET['section']) ? $_GET['section'] : 'home';

// نگاشت مقادیر انگلیسی به فارسی برای نمایش وضعیت
$status_display = [
    'pending' => 'در انتظار',
    'in_progress' => 'در حال انجام',
    'completed' => 'تکمیل شده',
    'cancelled' => 'لغو شده'
];

try {
    if (!$conn instanceof PDO) {
        throw new Exception('اتصال دیتابیس ($conn) معتبر نیست.');
    }

    // دریافت اطلاعات کاربر
    $stmt = $conn->prepare("SELECT id, email, name FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        session_unset();
        session_destroy();
        $error = 'حساب شما وجود ندارد. لطفاً وارد شوید.';
        header("Refresh: 2; url=login.php");
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
                $success = '">';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کاربر</title>
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
       
/*====================================
  RESET & BASE
====================================*/
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: iranSans;
}

body {
  background: #f0f2f5;
  line-height: 1.6;
}

/*====================================
  LAYOUT
====================================*/
.container {
  display: flex;
  flex-wrap: wrap;
  max-width: 1200px;
  width: 100%;
  margin: 30px auto;
  gap: 20px;
}

.sidebar {
  flex: 0 0 250px;
  background: #ffffff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.sidebar ul {
  list-style: none;
}

.sidebar li + li {
  margin-top: 8px;
}

.sidebar li a {
  display: block;
  padding: 10px;
  background: #f5f5f5;
  color: #333333;
  border-radius: 5px;
  text-decoration: none;
  transition: background 0.3s, color 0.3s;
}

.sidebar li a:hover,
.sidebar li a.active {
  background: rgb(22,24,23);
  color: #ffffff;
}

.content {
  flex: 1;
  background: #ffffff;
  border-radius: 10px;
  padding: 30px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  transition: padding 0.3s ease;
}

/*====================================
  COMPONENTS
====================================*/
.profile-card {
  background: #f9f9f9;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
}

h2 {
  margin-top: 0;
  color: rgb(18,208,78);
  font-size: 2rem;
  transition: font-size 0.3s;
}

p span {
  font-weight: bold;
  color: #444444;
}

.error,
.success {
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

input,
button {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  font-size: 14px;
  border: 2px solid #e0e0e0;
  border-radius: 6px;
  transition: padding 0.3s, font-size 0.3s;
}

button {
  background: rgb(23,25,24);
  color: #ffffff;
  border: none;
  cursor: pointer;
  transition: background 0.3s;
}

button:hover {
  background: rgb(18,231,124);
}

/*====================================
  ORDER STATUS COLORS
====================================*/
.status-pending     { color: orange; }
.status-in_progress { color: blue;   }
.status-completed   { color: green;  }
.status-cancelled   { color: red;    }

/*====================================
  RESPONSIVE BREAKPOINTS
====================================*/
/* Tablet & small desktops */
@media (max-width: 1024px) {
  .container {
    flex-direction: column;
    max-width: 95%;
    gap: 15px;
  }
  .sidebar {
    width: 100%;
    margin-bottom: 20px;
  }
  .content {
    padding: 20px;
  }
}

/* Large phones & small tablets */
@media (max-width: 768px) {
  .sidebar,
  .content,
  .profile-card {
    padding: 15px;
  }
  h2 {
    font-size: 1.6rem;
  }
  .sidebar li a {
    padding: 8px;
    font-size: 0.9rem;
  }
  input,
  button {
    padding: 8px;
    font-size: 0.85rem;
  }
}

/* Portrait mobiles */
@media (max-width: 480px) {
  .container {
    margin: 10px auto;
    gap: 10px;
  }
  h2 {
    font-size: 1.4rem;
  }
  p span {
    display: block;
    margin-bottom: 5px;
  }
  .sidebar li a {
    padding: 6px;
    font-size: 0.8rem;
  }
  input,
  button {
    padding: 6px;
    font-size: 0.75rem;
  }
}
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="index.php" class="<?= $section === 'home' ? 'active' : '' ?>">صفحه اصلی</a></li>
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

            <?php if ($section === 'home' && $user): ?>
                <h2>خوش آمدید به صفحه اصلی، <?= htmlspecialchars($user['name'] ?: $user['email']) ?>!</h2>
                <div class="profile-card">
                    <p>به پنل کاربری خود خوش آمدید! از منوی کناری می‌توانید به بخش‌های مختلف دسترسی پیدا کنید.</p>
                    <p><span>ایمیل:</span> <?= htmlspecialchars($user['email'] ?? '') ?></p>
                    <p><span>نام:</span> <?= htmlspecialchars($user['name'] ?? 'تنظیم نشده') ?></p>
                </div>

            <?php elseif ($section === 'dashboard' && $user): ?>
                <h2>خوش آمدید، <?= htmlspecialchars($user['name'] ?: $user['email']) ?>!</h2>
                <div class="profile-card">
                    <p><span>ایمیل:</span> <?= htmlspecialchars($user['email'] ?? '') ?></p>
                    <p><span>نام:</span> <?= htmlspecialchars($user['name'] ?? 'تنظیم نشده') ?></p>
                </div>

            <?php elseif ($section === 'profile' && $user): ?>
                <h2>پروفایل</h2>
                <form method="POST">
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" placeholder="نام">
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" placeholder="ایمیل" required>
                    <button type="submit">ذخیره</button>
                </form>

            <?php elseif ($section === 'settings' && $user): ?>
                <h2>تغییر رمز عبور</h2>
                <form method="POST">
                    <input type="password" name="current_password" placeholder="رمز فعلی" required>
                    <input type="password" name="new_password" placeholder="رمز جدید" required>
                    <button type="submit">تغییر رمز</button>
                </form>

            <?php elseif ($section === 'orders' && $user): ?>
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
                                    case 'pending':
                                        echo '<span class="status-pending">در انتظار</span>';
                                        break;
                                    case 'in_progress':
                                        echo '<span class="status-in_progress">در حال انجام</span>';
                                        break;
                                    case 'completed':
                                        echo '<span class="status-completed">تکمیل شده</span>';
                                        break;
                                    case 'cancelled':
                                        echo '<span class="status-cancelled">لغو شده</span>';
                                        break;
                                    default:
                                        echo htmlspecialchars($order['status']);
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