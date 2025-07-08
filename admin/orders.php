<?php include 'header.php' ?>

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
        $update = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $update->execute([$db_status, $order_id]);

        // بررسی تعداد ردیف‌های به‌روزرسانی شده
        if ($update->rowCount() > 0) {
            header("Location: orders.php?success=وضعیت با موفقیت به‌روزرسانی شد");
        } else {
            header("Location: orders.php?error=هیچ تغییری اعمال نشد. ممکن است سفارش وجود نداشته باشد یا وضعیت تغییر نکرده باشد.");
        }
        exit();
    } catch (Exception $e) {
        header("Location: orders.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارشات</title>
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.woff2') format('woff2');
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
            overflow-x: hidden;
        }
        header {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        header h1 {
            font-size: 2.2rem;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .order-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(14px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 6px 18px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.35);
        }
        .order-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg,#feb47b,#ff7e5f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .order-field {
            font-size: 0.9rem;
            line-height: 1.6;
            background: rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
        }
        .order-field strong {
            color: #ffae8f;
        }
        .back-btn {
            display: inline-block;
            margin: 2rem auto 0;
            padding: 0.8rem 2rem;
            background: #ff7e5f;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .back-btn:hover {
            background: #feb47b;
            transform: translateY(-3px);
        }
        .order-card form {
            margin-top: 0.5rem;
        }
        .order-card select, .order-card button {
            font-size: 0.85rem;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            border: none;
            margin-left: 0.4rem;
        }
        .order-card button {
            background: #ff7e5f;
            color: white;
            cursor: pointer;
        }
        .order-card button:hover {
            background: #feb47b;
        }
        .message {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 8px;
            text-align: center;
        }
        .success {
            background: rgba(0, 255, 0, 0.2);
            color: #0f0;
        }
        .error {
            background: rgba(255, 0, 0, 0.2);
            color: #f00;
        }
    </style>
</head>
<body>
    <header>
        <h1>لیست سفارشات</h1>
    </header>

    <div class="container">
        <?php
        // نمایش پیام موفقیت یا خطا
        if (isset($_GET['success'])) {
            echo '<div class="message success">' . htmlspecialchars($_GET['success']) . '</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="message error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>
        <div class="cards-grid">
            <?php
            $stmt = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
            foreach ($stmt as $row): ?>
                <div class="order-card">
                    <h3>سفارش #<?= htmlspecialchars($row['order_number']) ?></h3>
                    <div class="order-field"><strong>کد رهگیری:</strong> <?= htmlspecialchars($row['tracking_code']) ?></div>
                    <div class="order-field"><strong>نام:</strong> <?= htmlspecialchars($row['name']) ?></div>
                    <div class="order-field"><strong>ایمیل:</strong> <?= htmlspecialchars($row['email']) ?></div>
                    <div class="order-field"><strong>موبایل:</strong> <?= htmlspecialchars($row['phone']) ?></div>
                    <div class="order-field"><strong>نوع پروژه:</strong> <?= htmlspecialchars($row['project_type']) ?></div>
                    <div class="order-field"><strong>بودجه: </strong> <?= number_format($row['budget']) ?> تومان</div>
                    <div class="order-field"><strong>جزئیات:</strong> <?= nl2br(htmlspecialchars($row['details'])) ?></div>
                    <div class="order-field"><strong>تاریخ سفارش:</strong> <?= htmlspecialchars($row['order_date']) ?></div>
                    <div class="order-field"><strong>ددلاین:</strong> <?= htmlspecialchars($row['deadline']) ?></div>
                    <div class="order-field"><strong>روزها:</strong> <?= htmlspecialchars($row['days']) ?></div>
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
        </div>
        <div style="text-align:center;">
            <a href="index.php" class="back-btn">بازگشت به داشبورد</a>
        </div>
    </div>
</body>
</html>