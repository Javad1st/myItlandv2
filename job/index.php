<?php
// اتصال به پایگاه داده
require_once '../database1/db.php'; // مسیر فایل اتصال به دیتابیس

// دریافت دسته‌بندی‌ها از دیتابیس
$stmt = $conn->query("SELECT * FROM job_categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// دریافت دسته‌بندی انتخاب‌شده (اگر وجود داشته باشد)
$selectedCategoryId = isset($_POST['category_id']) ? $_POST['category_id'] : '';

// دریافت آگهی‌های شغلی از دیتابیس بر اساس دسته‌بندی انتخاب‌شده
if ($selectedCategoryId && $selectedCategoryId !== '') {
    $stmt = $conn->prepare("SELECT jobs.*, job_categories.name AS category_name FROM jobs
                            JOIN job_categories ON jobs.category_id = job_categories.id
                            WHERE jobs.category_id = :category_id");
    $stmt->execute(['category_id' => $selectedCategoryId]);
} else {
    $stmt = $conn->query("SELECT jobs.*, job_categories.name AS category_name FROM jobs
                          JOIN job_categories ON jobs.category_id = job_categories.id");
}

$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>فرصت‌های شغلی</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<header>فرصت‌های شغلی</header>
<div class="container">

  <!-- فرم فیلتر دسته‌بندی‌ها -->
  <div class="categories">
      
    <div class="category <?= !$selectedCategoryId ? 'active' : '' ?>" data-id="">همه</div>
    <?php foreach ($categories as $category): ?>
      <div class="category <?= $selectedCategoryId == $category['id'] ? 'active' : '' ?>" data-id="<?= $category['id'] ?>">
        <?= $category['name'] ?>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- نمایش آگهی‌های شغلی -->
  <div class="job-list" id="job-list">
    <?php foreach ($jobs as $job): ?>
      <div class="job-card" data-category="<?= $job['category_id'] ?>">
        <div class="title"><?= $job['title'] ?></div>
        <div class="details">
          <span><svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.24 2H5.34C3.15 2 2 3.15 2 5.33V7.23C2 9.41 3.15 10.56 5.33 10.56H7.23C9.41 10.56 10.56 9.41 10.56 7.23V5.33C10.57 3.15 9.42 2 7.24 2Z" fill="#1dba70"></path> <path opacity="0.4" d="M18.6695 2H16.7695C14.5895 2 13.4395 3.15 13.4395 5.33V7.23C13.4395 9.41 14.5895 10.56 16.7695 10.56H18.6695C20.8495 10.56 21.9995 9.41 21.9995 7.23V5.33C21.9995 3.15 20.8495 2 18.6695 2Z" fill="#1dba70"></path> <path d="M18.6695 13.4302H16.7695C14.5895 13.4302 13.4395 14.5802 13.4395 16.7602V18.6602C13.4395 20.8402 14.5895 21.9902 16.7695 21.9902H18.6695C20.8495 21.9902 21.9995 20.8402 21.9995 18.6602V16.7602C21.9995 14.5802 20.8495 13.4302 18.6695 13.4302Z" fill="#1dba70"></path> <path opacity="0.4" d="M7.24 13.4302H5.34C3.15 13.4302 2 14.5802 2 16.7602V18.6602C2 20.8502 3.15 22.0002 5.33 22.0002H7.23C9.41 22.0002 10.56 20.8502 10.56 18.6702V16.7702C10.57 14.5802 9.42 13.4302 7.24 13.4302Z" fill="#1dba70"></path> </g></svg> <?= $job['category_name'] ?></span>
          <span><svg fill="rgba(8, 199, 43, 0.78)" width="18px" height="18px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9,24H1a1,1,0,0,1,0-2H9a1,1,0,0,1,0,2Z M7,20H1a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z M5,16H1a1,1,0,0,1,0-2H5a1,1,0,0,1,0,2Z M13,23.955a1,1,0,0,1-.089-2A10,10,0,1,0,2.041,11.09a1,1,0,0,1-1.992-.18A12,12,0,0,1,24,12,11.934,11.934,0,0,1,13.09,23.951C13.06,23.954,13.029,23.955,13,23.955Z M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z"></path></g></svg> <?= $job['job_type'] ?></span>
          <span style="background-color: rgba(0, 197, 72, 0.16); padding: 4px; border-radius: 4px; width: fit-content;">سابقه: <?= $job['experience'] ?> </span>
        </div>
        <a href="resome.php?id=<?= $job['id'] ?>" class="apply-link"><p>ارسال رزومه</p> <svg width="29px" height="29px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#ffffff"></path> </g></svg> </a>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<script>
  // هنگامی که دسته‌بندی انتخاب می‌شود
  $(".category").click(function() {
    var categoryId = $(this).data("id");

    // هایلایت کردن دسته‌بندی انتخاب‌شده
    $(".category").removeClass("active");
    $(this).addClass("active");

    // ارسال درخواست AJAX برای دریافت آگهی‌ها بر اساس دسته‌بندی انتخاب‌شده
    $.ajax({
      url: "", // صفحه‌ای که در حال حاضر هستید
      method: "POST",
      data: { category_id: categoryId },
      success: function(response) {
        // فقط بخش آگهی‌ها را از پاسخ دریافت کرده و آن را به‌روزرسانی می‌کنیم
        var jobListHtml = $(response).find("#job-list").html(); // استخراج محتوای بخش job-list
        $("#job-list").html(jobListHtml); // به‌روزرسانی محتوای job-list
      }
    });
  });
</script>

</body>
</html>
