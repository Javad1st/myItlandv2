<?php
require_once './database/db.php';

function sanitize($value) {
    return htmlspecialchars(trim($value));
}

function isValidPhone($phone) {
    return preg_match('/^\d{11}$/', $phone);
}

function generateOrderCode($length = 5) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $code;
}

$fullname = sanitize($_POST['fullname']);
$user_phone = sanitize($_POST['user_phone']);
$user_email = sanitize($_POST['user_email']);
$user_telegram = sanitize($_POST['user_telegram']);
$package = sanitize($_POST['package']);
$team_phone = sanitize($_POST['team_phone']);
$description = sanitize($_POST['description']);
$order_code = generateOrderCode();

if (!isValidPhone($user_phone) || !isValidPhone($team_phone)) {
    die('شماره تماس باید ۱۱ رقمی باشد.');
}

try {
    $stmt = $conn->prepare("INSERT INTO orders2 
        (order_code, fullname, user_phone, user_email, user_telegram, package, team_phone, description)
        VALUES (:order_code, :fullname, :user_phone, :user_email, :user_telegram, :package, :team_phone, :description)");

    $stmt->bindParam(':order_code', $order_code);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':user_phone', $user_phone);
    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':user_telegram', $user_telegram);
    $stmt->bindParam(':package', $package);
    $stmt->bindParam(':team_phone', $team_phone);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
} catch (PDOException $e) {
    die("خطا در ثبت سفارش: " . $e->getMessage());
}
?>

<!-- نمایش فاکتور بعد از ثبت -->
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فاکتور سفارش</title>
    <link rel="stylesheet" href="packStyle.css">
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.7;
        }
        .contact-info {
            margin-top: 30px;
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
        .copy-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .copy-btn:hover {
            background-color: #45a049;
        }
        #copyMsg {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>فاکتور سفارش شما</h1>
        <p>
            <strong>کد سفارش:</strong> 
            <span id="orderCode"><?php echo $order_code; ?></span>
            <button onclick="copyOrderCode()" class="copy-btn">📋 کپی</button>
            <span id="copyMsg" style="display:none;">کپی شد!</span>
        </p>
        <p><strong>نام:</strong> <?php echo $fullname; ?></p>
        <p><strong>شماره تماس:</strong> <?php echo $user_phone; ?></p>
        <p><strong>ایمیل:</strong> <?php echo $user_email; ?></p>
        <p><strong>تلگرام:</strong> <?php echo $user_telegram; ?></p>
        <p><strong>پکیج انتخابی:</strong> <?php echo $package; ?></p>
        <p><strong>توضیحات:</strong> <?php echo $description; ?></p>
        <hr>
        <div class="contact-info">
            <p><span>📞 تماس با ما:</span> 09391234567</p>
            <p><span>💬 تلگرام:</span> @WebDesignTeam</p>
            <p><span>💬 ایتا:</span> @WebDesignTeam</p>
        </div>
    </div>
    <div class="footer">
        <p>با تشکر از سفارش شما. <a href="package.php">بازگشت به صفحه اصلی</a></p>
    </div>

    <script>
    function copyOrderCode() {
        const code = document.getElementById("orderCode").innerText;
        navigator.clipboard.writeText(code).then(() => {
            const msg = document.getElementById("copyMsg");
            msg.style.display = "inline";
            setTimeout(() => msg.style.display = "none", 2000);
        });
    }
    </script>
</body>
</html>
