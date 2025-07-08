<?php
/** submit_order.php
 *  وظیفه: دریافت اطلاعات فرم سفارش و ذخیره در جدول orders2 + ارسال ایمیل فاکتور
 *  پیش‌نیاز: کاربر وارد شده باشد ($_SESSION['user_id'])
 *  نگـارش: تمیز و امن با PDO + اعتبارسنجی + PHPMailer
 */

ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load PHPMailer
require 'vendor/autoload.php'; // اگر از Composer استفاده می‌کنی
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* ---------- 1) ابزار کمکی ---------- */
function dbg($msg) {
    file_put_contents('debug_session.txt', $msg . "\n", FILE_APPEND);
}
function sanitize(string $value): string {
    return trim($value);
}
function isValidPhone(string $phone): bool {
    return preg_match('/^\d{11}$/', $phone);
}
function generateOrderCode(int $length = 5): string {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
}

/* ---------- 2) اتصال دیتابیس ---------- */
if (!file_exists('./database/db.php')) {
    dbg("Error: db.php not found");
    http_response_code(500);
    exit('Database config missing');
}
require_once './database/db.php';

/* ---------- 3) کاربر لاگین باشد ---------- */
if (empty($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'لطفاً ابتدا وارد حساب کاربری خود شوید.';
    dbg("Redirect: user not logged in");
    header("Location: login.php");
    exit;
}
$user_id = (int)$_SESSION['user_id'];
dbg("User $user_id accessing submit_order");

/* ---------- 4) واکشی کاربر از DB ---------- */
try {
    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$userRow) {
        throw new Exception("User $user_id not found in DB");
    }
} catch (Throwable $e) {
    dbg("DB check user failed: " . $e->getMessage());
    $_SESSION['error_message'] = 'خطا در بررسی حساب کاربری.';
    header("Location: login.php");
    exit;
}

/* ---------- 5) داده‌های فرم ---------- */
$fullname      = sanitize($_POST['fullname']      ?? '');
$user_phone    = sanitize($_POST['user_phone']    ?? '');
$user_email    = sanitize($_POST['user_email']    ?? '');
$user_telegram = $_POST['user_telegram']  ?? '';
$package       = sanitize($_POST['package']       ?? '');
$description   = sanitize($_POST['description']   ?? '');
$days          = filter_var($_POST['days'] ?? '', FILTER_VALIDATE_INT);

$team_phone = '09301832546';
$status     = 'pending';

/* ---------- 6) اعتبارسنجی ---------- */
$errors = [];
if ($fullname === '')                         $errors[] = 'نام و نام خانوادگی الزامی است.';
if (!isValidPhone($user_phone))               $errors[] = 'شماره تماس باید ۱۱ رقم باشد.';
if (!isValidPhone($team_phone))               $errors[] = 'شماره ثابت تیم معتبر نیست.';
if ($user_email && !filter_var($user_email, FILTER_VALIDATE_EMAIL))
                                              $errors[] = 'ایمیل معتبر نیست.';
if ($package === '')                          $errors[] = 'پکیج انتخاب نشده است.';
if ($days === false || $days <= 0)            $errors[] = 'مهلت تحویل باید عددی مثبت باشد.';

if ($errors) {
    $_SESSION['error_message'] = implode(' ', $errors);
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}

/* ---------- 7) درج سفارش ---------- */
$order_code = generateOrderCode();
$sql = "INSERT INTO orders2
        (user_id, order_code, fullname, user_phone, user_email, user_telegram,
         package, team_phone, description, status, days, created_at)
        VALUES
        (:user_id, :order_code, :fullname, :user_phone, :user_email, :user_telegram,
         :package, :team_phone, :description, :status, :days, NOW())";

$params = [
    ':user_id'       => $user_id,
    ':order_code'    => $order_code,
    ':fullname'      => $fullname,
    ':user_phone'    => $user_phone,
    ':user_email'    => $user_email,
    ':user_telegram' => $user_telegram,
    ':package'       => $package,
    ':team_phone'    => $team_phone,
    ':description'   => $description,
    ':status'        => $status,
    ':days'          => $days
];
dbg("SQL params: " . json_encode($params, JSON_UNESCAPED_UNICODE));

try {
    $conn->prepare($sql)->execute($params);
    $_SESSION['success_message'] = "سفارش شما ثبت شد. کد سفارش: $order_code";

    /* ---------- 8) ارسال ایمیل ---------- */
    $mail = new PHPMailer(true);
    try {
        // تنظیمات سرور SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'myitland.ir@gmail.com';
        $mail->Password   = 'tcae fqhb huxl unqh';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // تنظیمات ایمیل
        $mail->setFrom('myitland.ir@gmail.com', 'وب‌سایت حرفه‌ای');
        $mail->addAddress($user_email); // ایمیل کاربر
        $mail->addAddress('support@myitland.ir'); // ایمیل تیم
        $mail->isHTML(true);

        // موضوع و محتوای ایمیل
        $mail->Subject = 'تأیید ثبت سفارش - کد: ' . $order_code;
        $mail->Body = '
            <html>
            <head>
                <style>
                    body { font-family: Vazir, Arial, sans-serif; direction: rtl; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 10px; }
                    h2 { color: #1a73e8; text-align: center; }
                    p { margin: 10px 0; }
                    .order-details { background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
                    .footer { text-align: center; margin-top: 20px; color: #777; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>تأیید ثبت سفارش</h2>
                    <p>مشتری گرامی ' . htmlspecialchars($fullname) . '،</p>
                    <p>سفارش شما با موفقیت ثبت شد. جزئیات سفارش شما به شرح زیر است:</p>
                    <div class="order-details">
                        <p><strong>کد سفارش:</strong> ' . htmlspecialchars($order_code) . '</p>
                        <p><strong>نام:</strong> ' . htmlspecialchars($fullname) . '</p>
                        <p><strong>شماره تماس:</strong> ' . htmlspecialchars($user_phone) . '</p>
                        <p><strong>ایمیل:</strong> ' . htmlspecialchars($user_email ?: 'وارد نشده') . '</p>
                        <p><strong>آیدی تلگرام/ایتا:</strong> ' . htmlspecialchars($user_telegram ?: 'وارد نشده') . '</p>
                        <p><strong>پکیج:</strong> ' . htmlspecialchars($package) . '</p>
                        <p><strong>مهلت تحویل:</strong> ' . htmlspecialchars($days) . ' روز</p>
                        <p><strong>توضیحات:</strong> ' . nl2br(htmlspecialchars($description ?: 'بدون توضیحات')) . '</p>
                        <p><strong>تاریخ ثبت:</strong> ' . date('Y-m-d H:i:s') . '</p>
                    </div>
                    <div class="footer">
                        <p>با تشکر از سفارش شما!</p>
                        <p>تیم پشتیبانی: myitland.ir@gmail.com | 09391234567</p>
                    </div>
                </div>
            </body>
            </html>';

        $mail->send();
        dbg("Email sent successfully to $user_email and support@myitland.ir");
    } catch (Exception $e) {
        dbg("Email sending failed: " . $mail->ErrorInfo);
        $_SESSION['error_message'] = 'سفارش ثبت شد، اما ارسال ایمیل با خطا مواجه شد: ' . $mail->ErrorInfo;
    }

    dbg("Session before redirect to invoice.php: " . print_r($_SESSION, true));
    header("Location: invoice.php?order_code=" . urlencode($order_code));
    exit;
} catch (Throwable $e) {
    dbg("Insert order error: " . $e->getMessage());
    $_SESSION['error_message'] = 'خطا در ثبت سفارش. لطفاً دوباره تلاش کنید.';
    header("Location: packageOrder.php?package=" . urlencode($package));
    exit;
}

/* ---------- 9) پایان ---------- */
ob_end_flush();
?>