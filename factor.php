<?php
session_start();

// Check if user is logged in and last_order exists
if (!isset($_SESSION['user_id']) || !isset($_SESSION['last_order'])) {
    header("Location: login.php");
    exit;
}

$order = $_SESSION['last_order'];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاکتور سفارش</title>
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

        .invoice-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .invoice-container h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .invoice-details {
            display: grid;
            gap: 1rem;
            font-size: 1.1rem;
        }

        .invoice-details p {
            background: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 10px;
        }

        .invoice-details strong {
            color: #ff7e5f;
        }

        .button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            background: #ff7e5f;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: #feb47b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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

            .invoice-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>فاکتور سفارش</h1>
    </header>

    <div class="container">
        <div class="invoice-container">
            <h2>جزئیات سفارش شما</h2>
            <div class="invoice-details">
                <p><strong>کد رهگیری:</strong> <?php echo htmlspecialchars($order['tracking_code']); ?></p>
                <p><strong>نام و نام خانوادگی:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                <p><strong>شماره تماس:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                <p><strong>نوع پروژه:</strong> <?php echo htmlspecialchars($order['project_type']); ?></p>
                <p><strong>جزئیات پروژه:</strong> <?php echo htmlspecialchars($order['details']); ?></p>
                <p><strong>بودجه تقریبی:</strong> <?php echo number_format($order['budget']); ?> تومان</p>
                <p><strong>مهلت تحویل (روز):</strong> <?php echo htmlspecialchars($order['days']); ?> روز</p>
            </div>
            <a href="order.php" class="button">ثبت سفارش جدید</a>
        </div>
    </div>

    <footer>
        <p>© 2025 طراحی شده توسط وبسایت آیتی لند | <a href="#">شرایط و ضوابط</a></p>
    </footer>
</body>
</html>