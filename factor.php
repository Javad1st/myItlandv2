<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    file_put_contents('debug.log', "Redirecting to login.php: user_id not set\n", FILE_APPEND);
    header("Location: login.php");
    exit;
}

$order = $_SESSION['last_order'];

// Ensure all expected keys exist to avoid undefined index errors
$order = array_merge([
    'tracking_code' => '---',
    'order_number' => '---',
    'name' => '---',
    'email' => '---',
    'phone' => '---',
    'project_type' => '---',
    'details' => '---',
    'budget' => 0,
    'days' => '---',
    'deadline' => '---'
], $order);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاکتور سفارش</title>
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

        * {
            font-family: iranSans;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
          
            color:rgb(26, 26, 26);
            direction: rtl;
            overflow-x: hidden;
        }
        header {
            background: linear-gradient(90deg,rgb(0, 255, 157),rgb(25, 238, 71));
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }
        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .invoice-container {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 15px;
          
        }
        .invoice-container h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color:rgb(0, 0, 0);
        }
        .invoice-details {
            display: grid;
            gap: 1rem;
            font-size: 1.1rem;
        }
        @media screen and (max-width:370px) {
            .invoice-details {
                font-size: 0.9rem;
            }
        }
        .invoice-details p {
            background: rgba(0, 0, 0, 0.05);
            padding: 1rem;
            border-radius: 10px;
        }
        .invoice-details strong {
            color:rgb(2, 163, 85);
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            background:rgb(17, 17, 17);
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .button:hover {
            background:rgb(46, 216, 83);
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
            color:rgb(52, 206, 90);
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
            .buttons {
                flex-direction: column;
                gap: 0.5rem;
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
                <p><strong>شماره سفارش:</strong> <?php echo htmlspecialchars($order['order_number']); ?></p>
                <p><strong>نام و نام خانوادگی:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
                <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                <p><strong>شماره تماس:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                <p><strong>نوع پروژه:</strong> <?php echo htmlspecialchars($order['project_type']); ?></p>
                <p><strong>جزئیات پروژه:</strong> <?php echo nl2br(htmlspecialchars($order['details'])); ?></p>
                <p><strong>بودجه تقریبی:</strong> <?php echo number_format($order['budget']); ?> تومان</p>
                <p><strong>مهلت تحویل:</strong> <?php echo htmlspecialchars($order['deadline']); ?></p>
                <p><strong>تعداد روزها:</strong> <?php echo htmlspecialchars($order['days']); ?> روز</p>
            </div>
            <div class="buttons">
                <a href="order.php" class="button">ثبت سفارش جدید</a>
                <a href="dashboard.php?section=orders" class="button">بازگشت به داشبورد</a>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 طراحی شده توسط وبسایت آیتی لند | <a href="#">شرایط و ضوابط</a></p>
    </footer>
</body>
</html>