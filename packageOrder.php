<?php
$package = $_GET['package'] ?? 'نامشخص';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم سفارش</title>
    <link href="packStyle.css" rel="stylesheet">
</head>
<body>
    <h1>فرم سفارش - پکیج <?php echo htmlspecialchars($package); ?></h1>
    <form action="submit_order.php" method="post">
        <input type="hidden" name="package" value="<?php echo htmlspecialchars($package); ?>">
        <label>نام کامل:</label><input type="text" name="fullname" required><br>
        <label>شماره تماس:</label><input type="text" name="user_phone" required><br>
        <label>ایمیل:</label><input type="email" name="user_email"><br>
        <label>آیدی تلگرام:</label><input type="text" name="user_telegram"><br>
        <label>شماره تماس تیم شما:</label><input type="text" name="team_phone" required><br>
        <label>توضیحات:</label><textarea name="description"></textarea><br>
        <button type="submit">ثبت سفارش</button>
    </form>
</body>
</html>