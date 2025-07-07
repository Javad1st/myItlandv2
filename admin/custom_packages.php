<?php  include 'header.php' ?>

<?php

require_once '../database/db.php';

// نگاشت مقادیر فارسی به انگلیسی برای دیتابیس
$status_map = [
    'در انتظار' => 'pending',
    'در حال انجام' => 'in_progress',
    'انجام شده' => 'completed',
    'لغو شده' => 'cancelled'
];

// نگاشت مقادیر انگلیسی به فارسی برای نمایش
$status_display = [
    'pending' => 'در انتظار',
    'in_progress' => 'در حال انجام',
    'completed' => 'انجام شده',
    'cancelled' => 'لغو شده'
];

// بررسی درخواست POST برای به‌روزرسانی وضعیت
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'], $_POST['order_id'])) {
    try {
        $status = $_POST['status'];
        $order_id = intval($_POST['order_id']);
        
        // بررسی مقادیر معتبر برای وضعیت
        if (!array_key_exists($status, $status_map)) {
            throw new Exception("وضعیت نامعتبر است");
        }

        // تبدیل وضعیت فارسی به انگلیسی برای دیتابیس
        $db_status = $status_map[$status];

        // آماده‌سازی و اجرای کوئری
        $update = $conn->prepare("UPDATE orders2 SET status = ? WHERE id = ?");
        $update->execute([$db_status, $order_id]);

        // بررسی تعداد ردیف‌های به‌روزرسانی شده
        if ($update->rowCount() > 0) {
            header("Location: custom_packages.php?success=وضعیت با موفقیت به‌روزرسانی شد");
        } else {
            header("Location: custom_packages.php?error=هیچ تغییری اعمال نشد. ممکن است سفارش وجود نداشته باشد یا وضعیت تغییر نکرده باشد.");
        }
        exit();
    } catch (Exception $e) {
        header("Location: custom_packages.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

// دریافت سفارشات
try {
    $stmt = $conn->prepare("SELECT id, user_id, order_code, fullname, user_phone, user_email, user_telegram, package, team_phone, description, created_at, status FROM orders2 ORDER BY created_at DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = 'خطا در دریافت سفارشات: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پکیج‌های سفارشی</title>
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
        body {
            font-family: iranSans, Tahoma, sans-serif;
            background: linear-gradient(135deg, #1e1e2f 0%, #2a2a4e 100%);
            margin: 0;
            padding: 0;
            color: #e0e0e0;
            overflow-x: hidden;
        }
        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2.2rem;
            color: #fff;
            background: linear-gradient(90deg, #5e548e, #9579b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }
        .order-card {
            background: #2e2e4a;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .order-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
        }
        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #5e548e, #9579b7);
            transition: height 0.3s ease;
        }
        .order-card:hover::before {
            height: 10px;
        }
        .order-card h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }
        .order-field {
            font-size: 1rem;
            margin-bottom: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            line-height: 1.6;
        }
        .order-field strong {
            color: #9579b7;
        }
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 10px;
            text-align: center;
            font-size: 1rem;
        }
        .success {
            background: rgba(0, 255, 0, 0.15);
            color: #00ff00;
        }
        .error {
            background: rgba(255, 0, 0, 0.15);
            color: #ff0000;
        }
        .order-card form {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
        }
        .order-card select, .order-card button {
            padding: 10px 15px;
            border-radius: 10px;
            border: none;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .order-card select {
            background: #3a3a5c;
            color: #e0e0e0;
            min-width: 120px;
        }
        .order-card button {
            background: linear-gradient(90deg, #5e548e, #9579b7);
            color: #fff;
        }
        .order-card button:hover {
            background: linear-gradient(90deg, #9579b7, #5e548e);
            transform: scale(1.05);
        }
        .back-btn {
            display: block;
            width: fit-content;
            margin: 30px auto;
            padding: 12px 30px;
            background: linear-gradient(90deg, #5e548e, #9579b7);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-align: center;
        }
        .back-btn:hover {
            background: linear-gradient(90deg, #9579b7, #5e548e);
            transform: scale(1.05);
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            .cards-grid {
                grid-template-columns: 1fr;
            }
            .order-card {
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>پکیج‌های سفارشی</h1>
        </div>
        <?php
        // نمایش پیام موفقیت یا خطا
        if (isset($_GET['success'])) {
            echo '<div class="message success">' . htmlspecialchars($_GET['success']) . '</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="message error">' . htmlspecialchars($_GET['error']) . '</div>';
        } elseif (isset($error)) {
            echo '<div class="message error">' . htmlspecialchars($error) . '</div>';
        }
        ?>
        <div class="cards-grid">
            <?php if (empty($orders)): ?>
                <div class="message error">هیچ سفارشی یافت نشد.</div>
            <?php else: ?>
                <?php foreach ($orders as $row): ?>
                    <div class="order-card">
                        <h3>پکیج #<?= htmlspecialchars($row['order_code']) ?></h3>
                        <div class="order-field"><strong>شناسه کاربر:</strong> <?= htmlspecialchars($row['user_id']) ?></div>
                        <div class="order-field"><strong>نام کامل:</strong> <?= htmlspecialchars($row['fullname']) ?></div>
                        <div class="order-field"><strong>تلفن کاربر:</strong> <?= htmlspecialchars($row['user_phone']) ?></div>
                        <div class="order-field"><strong>ایمیل کاربر:</strong> <?= htmlspecialchars($row['user_email']) ?></div>
                        <div class="order-field"><strong>تلگرام کاربر:</strong> <?= htmlspecialchars($row['user_telegram'] ?: '---') ?></div>
                        <div class="order-field"><strong>پکیج:</strong> <?= htmlspecialchars($row['package']) ?></div>
                        <div class="order-field"><strong>تلفن تیم:</strong> <?= htmlspecialchars($row['team_phone'] ?: '---') ?></div>
                        <div class="order-field"><strong>توضیحات:</strong> <?= nl2br(htmlspecialchars($row['description'])) ?></div>
                        <div class="order-field"><strong>تاریخ ثبت:</strong> <?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></div>
                        <div class="order-field">
                            <strong>وضعیت:</strong> <?= htmlspecialchars($status_display[$row['status']] ?? $row['status']) ?>
                            <form method="post">
                                <select name="status">
                                    <option value="در انتظار" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>در انتظار</option>
                                    <option value="در حال انجام" <?= $row['status'] == 'in_progress' ? 'selected' : '' ?>>در حال انجام</option>
                                    <option value="انجام شده" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>انجام شده</option>
                                    <option value="لغو شده" <?= $row['status'] == 'cancelled' ? 'selected' : '' ?>>لغو شده</option>
                                </select>
                                <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                <button type="submit">بروزرسانی</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a href="index.php" class="back-btn">بازگشت به داشبورد</a>
    </div>
</body>
</html>