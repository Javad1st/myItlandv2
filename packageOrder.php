<?php
ob_start();
session_start();

// Log session for debugging
file_put_contents('debug.log', "Session at start of order_form.php: " . print_r($_SESSION, true) . "\n", FILE_APPEND);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    file_put_contents('debug.log', "Redirecting to login.php from order_form.php: user_id not set\n", FILE_APPEND);
    header("Location: login.php");
    exit;
}

// Database connection to fetch user data
if (!file_exists('database/db.php')) {
    die('خطا: فایل db.php یافت نشد.');
}
require_once 'database/db.php';

try {
    if (!isset($conn) || !$conn instanceof PDO) {
        throw new Exception('اتصال دیتابیس ($conn) معتبر نیست.');
    }
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        file_put_contents('debug.log', "Redirecting to login.php from order_form.php: user not found for user_id {$_SESSION['user_id']}\n", FILE_APPEND);
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
} catch (Exception $e) {
    file_put_contents('debug.log', "Error in order_form.php: " . $e->getMessage() . "\n", FILE_APPEND);
    die("خطا: " . htmlspecialchars($e->getMessage()));
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$package = $_GET['package'] ?? 'نامشخص';
$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage = $_SESSION['error_message'] ?? '';

// Clear session messages
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>فرم سفارش</title>
  <link rel="stylesheet" href="packStyle.css" />
</head>
<body>
  <div class="container">
    <div class="background">
      <div class="head">
        <h1>فرم سفارش − پکیج <?php echo htmlspecialchars($package); ?></h1>
        <div class="line"></div>
      </div>

      <!-- Display messages -->
      <?php if ($successMessage): ?>
        <div style="background-color:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:5px;">
          <?php echo htmlspecialchars($successMessage); ?>
        </div>
      <?php endif; ?>

      <?php if ($errorMessage): ?>
        <div style="background-color:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:5px;">
          <?php echo htmlspecialchars($errorMessage); ?>
        </div>
      <?php endif; ?>

      <div class="gridContainer">
        <form action="submit_order.php" method="post" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
          <input type="hidden" name="package" value="<?php echo htmlspecialchars($package); ?>">

          <div class="form-groups">
            <div class="form-group grid1">
              <div class="svg-flex">
                <label for="fullname">نام کامل</label>
                <!-- آیکون -->
              </div>
              <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['name']); ?>" readonly required />
            </div>

            <div class="form-group grid2">
              <div class="svg-flex">
                <label for="user_phone">شماره تماس</label>
                <!-- آیکون -->
              </div>
              <input type="tel" id="user_phone" name="user_phone" required />
            </div>
          </div>

          <div class="form-groups">
            <div class="form-group grid3">
              <div class="svg-flex">
                <label for="user_email">ایمیل</label>
                <!-- آیکون -->
              </div>
              <input type="email" id="user_email" name="user_email" value="<?php echo htmlspecialchars($user['email']); ?>"  readonly required />
            </div>

            <div class="form-group grid4">
              <div class="svg-flex">
                <label for="user_telegram">آیدی تلگرام یا ایتا</label>
                <!-- آیکون -->
              </div>
              <input type="text" id="user_telegram" name="user_telegram" />
            </div>
          </div>

          <div class="form-group">
            <div class="svg-flex">
              <label for="description">توضیحات</label>
              <!-- آیکون -->
            </div>
            <textarea id="description" name="description" rows="4"></textarea>
          </div>

          <!-- Added fields for budget and days -->
          <div class="form-group">
            <div class="svg-flex">
              <label for="budget">بودجه (تومان)</label>
              <!-- آیکون -->
            </div>
            <input type="text" id="budget" name="budget" required />
          </div>

          <div class="form-group">
            <div class="svg-flex">
              <label for="days">مهلت تحویل (روز)</label>
              <!-- آیکون -->
            </div>
            <input type="number" id="days" name="days" required />
          </div>

          <button type="submit">ثبت سفارش</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>