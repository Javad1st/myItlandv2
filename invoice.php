<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log session for debugging
function dbg($msg) {
    file_put_contents('debug_session.txt', $msg . "\n", FILE_APPEND);
}
dbg("Session at start of invoice.php: " . print_r($_SESSION, true));

if (!file_exists('./database/db.php')) {
    dbg("Error: db.php not found in invoice.php");
    die('خطا: فایل db.php یافت نشد.');
}

require_once './database/db.php';

function sanitize($value) {
    return htmlspecialchars(trim($value));
}

// بررسی ورود کاربر
if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    dbg("Redirect: user not logged in from invoice.php");
    $_SESSION['error_message'] = 'لطفاً ابتدا وارد حساب کاربری خود شوید.';
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$order_code = sanitize($_GET['order_code'] ?? '');
$error = '';
$order = null;

if (empty($order_code)) {
    $error = 'کد سفارش نامعتبر است.';
} else {
    try {
        // بازیابی سفارش فقط برای کاربر فعلی
        $stmt = $conn->prepare("SELECT order_code, fullname, user_phone, user_email, user_telegram, package, team_phone, description, created_at 
                                FROM orders2 
                                WHERE order_code = :order_code AND user_id = :user_id");
        $stmt->bindParam(':order_code', $order_code);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            $error = 'سفارش با این کد یافت نشد یا متعلق به شما نیست.';
            dbg("Error: Order $order_code not found for user $user_id");
        }
    } catch (PDOException $e) {
        $error = 'خطا در بازیابی سفارش: ' . $e->getMessage();
        dbg("Database error in invoice.php: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاکتور سفارش | وب‌سایت حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css">
    <style>
        body {
            font-family: 'Vazir', sans-serif;
            direction: rtl;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color: #1a73e8;
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 500;
        }
        p {
            font-size: 16px;
            line-height: 1.7;
            color: #333;
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
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s, transform 0.2s;
        }
        .copy-btn:hover {
            background-color: #1557b0;
            transform: translateY(-2px);
        }
        #copyMsg {
            color: #2e7d32;
            font-weight: bold;
        }
        .error {
            color: #d32f2f;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            background: #ffebee;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            color: #2e7d32;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
        }
        @media (max-width: 500px) {
            .container {
                margin: 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>فاکتور سفارش شما</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php elseif (isset($_SESSION['success_message'])): ?>
            <p class="success"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></p>
        <?php endif; ?>
        <?php if ($order): ?>
            <p>
                <strong>کد سفارش:</strong> 
                <span id="orderCode"><?php echo htmlspecialchars($order['order_code']); ?></span>
                <button onclick="copyOrderCode()" class="copy-btn">📋 کپی</button>
                <span id="copyMsg" style="display:none;">کپی شد!</span>
            </p>
            <p><strong>نام:</strong> <?php echo htmlspecialchars($order['fullname']); ?></p>
            <p><strong>شماره تماس:</strong> <?php echo htmlspecialchars($order['user_phone']); ?></p>
            <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($order['user_email'] ?: 'وارد نشده'); ?></p>
            <p><strong>تلگرام:</strong> <?php echo htmlspecialchars($order['user_telegram'] ?: 'وارد نشده'); ?></p>
            <p><strong>پکیج انتخابی:</strong> <?php echo htmlspecialchars($order['package']); ?></p>
            <p><strong>توضیحات:</strong> <?php echo htmlspecialchars($order['description'] ?: 'بدون توضیحات'); ?></p>
            <p><strong>تاریخ ثبت:</strong> <?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($order['created_at']))); ?></p>
            <hr>
            <div class="contact-info">
                <p><span>📞 تماس با ما:</span> 09391234567</p>
                <p><span>💬 تلگرام:</span> @WebDesignTeam</p>
                <p><span>💬 ایتا:</span> @WebDesignTeam</p>
            </div>
        <?php endif; ?>
        <div class="footer">
            <p>با تشکر از سفارش شما. <a href="packageOrder.php">بازگشت به صفحه اصلی</a></p>
        </div>
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
<?php ob_end_flush(); ?>