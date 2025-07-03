<?php
session_start();

$package = $_GET['package'] ?? 'نامشخص';

$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage = $_SESSION['error_message'] ?? '';

// پاک کردن پیام‌ها بعد از خواندن
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

      <!-- نمایش پیام‌ها -->
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
          <input type="hidden" name="package" value="<?php echo htmlspecialchars($package); ?>">

          <div class="form-groups">
            <div class="form-group grid1">
              <div class="svg-flex">
                <label for="fullname">نام کامل</label>
                <!-- آیکون -->
              </div>
              <input type="text" id="fullname" name="fullname" required />
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
              <input type="email" id="user_email" name="user_email" />
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

          <button type="submit">ثبت سفارش</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
