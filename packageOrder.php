<?php
ob_start();
session_start();

// Log session for debugging
file_put_contents('debug.log', "Session at start of packageOrder.php: " . print_r($_SESSION, true) . "\n", FILE_APPEND);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    file_put_contents('debug.log', "Redirecting to login.php from packageOrder.php: user_id not set\n", FILE_APPEND);
    $_SESSION['error_message'] = 'لطفاً ابتدا وارد شوید.';
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
        file_put_contents('debug.log', "Redirecting to login.php from packageOrder.php: user not found for user_id {$_SESSION['user_id']}\n", FILE_APPEND);
        session_unset();
        session_destroy();
        $_SESSION['error_message'] = 'کاربر یافت نشد. لطفاً دوباره وارد شوید.';
        header("Location: login.php");
        exit;
    }
} catch (Exception $e) {
    file_put_contents('debug.log', "Error in packageOrder.php: " . $e->getMessage() . "\n", FILE_APPEND);
    die("خطا: " . htmlspecialchars($e->getMessage()));
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$package = htmlspecialchars($_GET['package'] ?? 'نامشخص', ENT_QUOTES, 'UTF-8');
$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage = $_SESSION['error_message'] ?? '';

// Clear session messages
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>فرم سفارش - پکیج <?php echo htmlspecialchars($package); ?></title>
    <link rel="stylesheet" href="packStyle.css">
    <style>
        :root {
            --primary: #28a745;
            --primary-light: #5cd67a;
            --bg-gradient: linear-gradient(135deg, rgb(244, 252, 246) 0%, rgb(227, 227, 227) 100%);
            --font: iranSans, Vazir, sans-serif;
            --radius: 10px;
            --transition: 0.3s ease-in-out;
        }
        * {
            font-family: var(--font);
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .background {
            background: #fff;
            padding: 2rem;
            border-radius: var(--radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        .head h1 {
            text-align: center;
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        .line {
            height: 2px;
            background: var(--primary);
            margin-bottom: 1.5rem;
        }
        .form-groups {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .form-group {
            position: relative;
        }
        .svg-flex {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .form-group label {
            font-size: 0.9rem;
            color: #333;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            font-size: 1rem;
            background: #fafafa;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
            outline: none;
        }
        .form-group textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 0.8rem;
            background: rgb(28, 28, 28);
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background var(--transition), transform 0.2s ease-out;
        }
        button:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }
        @media (max-width: 600px) {
            .form-groups {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="background">
            <div class="head">
                <h1>فرم سفارش - پکیج <?php echo htmlspecialchars($package); ?></h1>
                <div class="line"></div>
            </div>

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
                            </div>
                            <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['name']); ?>" readonly required />
                        </div>

                        <div class="form-group grid2">
                            <div class="svg-flex">
                                <label for="user_phone">شماره تماس</label>
                            </div>
                            <input type="tel" id="user_phone" name="user_phone" pattern="[0-9]{10,11}" placeholder="09123456789" required />
                        </div>
                    </div>

                    <div class="form-groups">
                        <div class="form-group grid3">
                            <div class="svg-flex">
                                <label for="user_email">ایمیل</label>
                            </div>
                            <input type="email" id="user_email" name="user_email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly required />
                        </div>

                        <div class="form-group grid4">
                            <div class="svg-flex">
                                <label for="user_telegram">آیدی تلگرام یا ایتا</label>
                            </div>
                            <input type="text" id="user_telegram" name="user_telegram" placeholder="@username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="svg-flex">
                            <label for="description">توضیحات</label>
                        </div>
                        <textarea id="description" name="description" rows="4" placeholder="توضیحات سفارش خود را وارد کنید"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="svg-flex">
                            <label for="budget">بودجه (تومان)</label>
                        </div>
                        <input type="number" id="budget" name="budget" min="0" step="1000" placeholder="مثال: 500000" required />
                    </div>

                    <div class="form-group">
                        <div class="svg-flex">
                            <label for="days">مهلت تحویل (روز)</label>
                        </div>
                        <input type="number" id="days" name="days" min="1" placeholder="مثال: 7" required />
                    </div>

                    <button type="submit">ثبت سفارش</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
