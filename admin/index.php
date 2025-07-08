
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.woff2') format('woff2');
        }
        * {
            font-family: 'Vazir', sans-serif;
        }
        body {
            background: #f9fafb;
            color: #1e293b;
        }
        .header {
            background: linear-gradient(90deg, #0f172a, #1e293b);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(90deg, #60a5fa, #93c5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .sidebar {
            background-color: #1e293b;
            color: #fff;
            height: 100vh;
            padding-top: 1rem;
            position: fixed;
            right: 0;
            top: 0;
            width: 240px;
            z-index: 1000;
        }
        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 0.75rem 1.5rem;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #2563eb;
            color: #fff;
        }
        .content {
            margin-right: 240px;
            padding: 2rem;
            min-height: 100vh;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 1.5rem;
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .card i {
            font-size: 2rem;
            margin-bottom: 0.75rem;
            color: #3b82f6;
        }
        .gradient-text {
            background: linear-gradient(90deg, #1d4ed8, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .content {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">داشبورد</div>
        <div class="d-flex align-items-center gap-3">
            <span>خوش آمدید ادمین</span>
            <a href="adminout.php" class="btn btn-sm btn-danger">خروج</a>
        </div>
    </div>

    <div class="sidebar">
        <a href="index.php" class="active"><i class="fas fa-home me-2"></i>خانه</a>
        <a href="users.php"><i class="fas fa-users me-2"></i>کاربران</a>
        <a href="comments.php"><i class="fas fa-comments me-2"></i>نظرات</a>
        <a href="addblog.php"><i class="fas fa-plus me-2"></i>افزودن مقاله</a>
        <a href="blogs.php"><i class="fas fa-list me-2"></i>لیست مقالات</a>
        <a href="addwriter.php"><i class="fas fa-user-plus me-2"></i>افزودن نویسنده</a>
        <a href="writers.php"><i class="fas fa-user-edit me-2"></i>نویسندگان</a>
        <a href="orders.php"><i class="fas fa-shopping-cart me-2"></i>سفارشات</a>
        <a href="custom_packages.php"><i class="fas fa-shopping-cart me-2"></i>سفارشات(پکیج)</a>

    </div>

    <div class="content">
        <h2 class="gradient-text mb-4">داشبورد مدیریت</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card text-center">
                    <i class="fas fa-users"></i>
                    <h5 class="mt-3">مدیریت کاربران</h5>
                    <p class="text-muted">مدیریت کاربران سایت</p>
                    <a href="users.php" class="btn btn-primary btn-sm">مشاهده</a>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <i class="fas fa-file-alt"></i>
                    <h5 class="mt-3">مقالات</h5>
                    <p class="text-muted">افزودن یا ویرایش مقالات</p>
                    <a href="blogs.php" class="btn btn-primary btn-sm">مشاهده</a>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <i class="fas fa-comments"></i>
                    <h5 class="mt-3">نظرات</h5>
                    <p class="text-muted">مدیریت نظرات کاربران</p>
                    <a href="comments.php" class="btn btn-primary btn-sm">مشاهده</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>