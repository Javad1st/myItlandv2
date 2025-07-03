<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!file_exists('./database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}

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

// بررسی ورود کاربر
if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
    $_SESSION['error_message'] = 'لطفاً ابتدا وارد حساب کاربری خود شوید.';
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// بررسی وجود user_id در جدول users
try {
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    if (!$stmt) {
        throw new Exception('خطا در آماده‌سازی کوئری: ' . implode(' ', $conn->errorInfo()));
    }
    $stmt->execute([$user_id]);
    if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['error_message'] = 'حساب کاربری شما یافت نشد. لطفاً دوباره وارد شوید.';
        unset($_SESSION['user']);
        header("Location: login.php");
        exit;
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = 'خطا در بررسی حساب کاربری: ' . $e->getMessage();
    header("Location: packageOrder.php?package=" . urlencode($_POST['package'] ?? ''));
    exit;
}

// گرفتن داده‌ها از فرم
$fullname = sanitize($_POST['fullname'] ?? '');
$user_phone = sanitize($_POST['user_phone'] ?? '');
$user_email = sanitize($_POST['user_email'] ?? '');
$user_telegram = sanitize($_POST['user_telegram'] ?? '');
$package = sanitize($_POST['package'] ?? '');
$description = sanitize($_POST['description'] ?? '');
$team_phone = '09301832546'; // شماره ثابت تیم

// اعتبارسنجی ورودی‌ها
if (empty($fullname)) {
    $_SESSION['error_message'] = 'لطفاً نام و نام خانوادگی را وارد کنید.';
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}
if (!isValidPhone($user_phone) || !isValidPhone($team_phone)) {
    $_SESSION['error_message'] = 'شماره تماس باید ۱۱ رقمی باشد.';
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}
if (!empty($user_email) && !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_message'] = 'لطفاً ایمیل معتبر وارد کنید.';
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}
if (empty($package)) {
    $_SESSION['error_message'] = 'لطفاً پکیج را انتخاب کنید.';
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}

$order_code = generateOrderCode();

try {
    $stmt = $conn->prepare("INSERT INTO orders2 
        (user_id, order_code, fullname, user_phone, user_email, user_telegram, package, team_phone, description, created_at)
        VALUES (:user_id, :order_code, :fullname, :user_phone, :user_email, :user_telegram, :package, :team_phone, :description, NOW())");

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':order_code', $order_code);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':user_phone', $user_phone);
    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':user_telegram', $user_telegram);
    $stmt->bindParam(':package', $package);
    $stmt->bindParam(':team_phone', $team_phone);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    // هدایت به invoice.php با order_code
    $_SESSION['success_message'] = "سفارش شما با موفقیت ثبت شد. کد سفارش: $order_code";
    header("Location: invoice.php?order_code=" . urlencode($order_code));
    exit;
} catch (PDOException $e) {
    $_SESSION['error_message'] = "خطا در ثبت سفارش: " . $e->getMessage();
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}
?>