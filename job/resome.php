<?php
// اتصال به دیتابیس
require_once '../database1/db.php';

// بررسی وجود id در URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "آگهی مورد نظر پیدا نشد.";
  exit;
}

$jobId = (int) $_GET['id']; // تبدیل به عدد برای امنیت

// دریافت اطلاعات آگهی بر اساس id
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = :id");
$stmt->execute(['id' => $jobId]);
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// اگر آگهی پیدا نشد
if (!$job) {
  echo "آگهی مورد نظر وجود ندارد.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($job['title']) ?></title>
  <link rel="stylesheet" href="resomeStyle.css">
</head>
<body>
  <div class="main-container">
    <div class="job-ad-container">
      <div class="left-column">
        <h1><?= htmlspecialchars($job['title']) ?></h1>
        <div class="job-description">
          <h2>شرح شغل و وظایف:</h2>
          <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
          <h2>مسئولیت‌ها و مهارت‌ها:</h2>
          <ul>
                          <li> مهارت ها: <?= htmlspecialchars($job['skills']) ?></li>

            <li>وضعیت سربازی: <?= htmlspecialchars($job['military_status']) ?></li>
            <li>ساعت کاری: <?= htmlspecialchars($job['work_hours']) ?></li>
            <li>شیوه پرداخت: <?= htmlspecialchars($job['payment_method']) ?></li>
            <li>شیفت کاری: <?= htmlspecialchars($job['shift']) ?></li>
          </ul>
        </div>
      </div>

      <div class="right-column">
        <div class="job-meta">
          <p><strong> <svg style="margin-left: 0.2rem;" fill="black" width="18px" height="18px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9,24H1a1,1,0,0,1,0-2H9a1,1,0,0,1,0,2Z M7,20H1a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z M5,16H1a1,1,0,0,1,0-2H5a1,1,0,0,1,0,2Z M13,23.955a1,1,0,0,1-.089-2A10,10,0,1,0,2.041,11.09a1,1,0,0,1-1.992-.18A12,12,0,0,1,24,12,11.934,11.934,0,0,1,13.09,23.951C13.06,23.954,13.029,23.955,13,23.955Z M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z"></path></g></svg></strong> <?= htmlspecialchars($job['job_type']) ?></p>
          <p><strong><svg width="24px" height="24px" style="margin-left: 0.2rem;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></strong> <?= htmlspecialchars($job['province']) ?></p>
          <p><strong>تجربه کاری:</strong> <?= htmlspecialchars($job['experience']) ?></p>
          <p><strong>حقوق و دستمزد:</strong> <?= number_format($job['salary']) ?> تومان</p>
        </div>
        <div class="apply-section">
          <button id="applyBtn">ارسال مشخصات</button>
        </div>
      </div>
    </div>
  </div>
<style>
  .message-box {
  background-color: #d4edda;
  color: #155724;
  padding: 10px 15px;
  margin: 15px;
  border: 1px solid #c3e6cb;
  border-radius: 6px;
  font-size: 14px;
  text-align: center;
}
.message-box.error {
  background-color: #f8d7da;
  color: #721c24;
  border-color: #f5c6cb;
}

</style>
  <!-- فرم مودال ارسال رزومه -->
  <form class="modal-form" enctype="multipart/form-data" method="post" action="submit_resume.php">
    <div id="modal" class="modal">
    <div id="messageBox" class="message-box" style="display: none;"></div>

      <div class="modal-container">
        <span class="close-btn">&times;</span>

        <header class="modal-header">
          <h2>ارسال رزومه و اطلاعات فردی</h2>
          <p>لطفاً فرم زیر را تکمیل کنید. تمامی اطلاعات وارد شده محرمانه بوده و با دقت بررسی می‌شود.</p>
        </header>

        <div class="form-group">
          <label for="fullname">نام و نام خانوادگی</label>
          <input type="text" id="fullname" name="fullname" required>
        </div>
        <div class="form-group">
          <label for="email">کد ملی</label>
          <input type="text" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone">شماره تماس</label>
          <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="jobTitle">آدرس</label>
          <input type="text" id="jobTitle" name="jobTitle" required>
        </div>
        <div class="form-group">
          <label for="resume">آپلود رزومه</label>
          <input type="file" id="resume" name="resume" required>
        </div>
        <div class="form-group">
          <label for="coverLetter">سابقه کار</label>
          <textarea id="coverLetter" name="coverLetter" rows="4"></textarea>
        </div>
        <div class="form-group">
  <label for="military_status">وضعیت سربازی</label>
  <select id="military_status" name="military_status" required>
    <option value="">انتخاب کنید...</option>
    <option value="معاف دائم">معاف دائم</option>
    <option value="معاف موقت">معاف موقت</option>
    <option value="پایان خدمت">پایان خدمت</option>
    <option value="در حال خدمت">در حال خدمت</option>
    <option value="نیاز به توضیح بیشتر">نیاز به توضیح بیشتر</option>
  </select>
</div>

        <footer class="modal-footer">
          <p>با ارسال رزومه، شرایط و قوانین را می‌پذیرید.</p>
        </footer>
      </div>
      <div class="modal-container2">
        <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
        <button type="submit" class="submit-btn">ارسال رزومه</button>
      </div>
    </div>
  </form>

  <script>
    document.querySelector(".close-btn").addEventListener("click", function () {
      document.getElementById("modal").classList.remove("show");
    });

    window.addEventListener("click", function (event) {
      if (event.target === document.getElementById("modal")) {
        document.getElementById("modal").classList.remove("show");
      }
    });

    document.addEventListener("DOMContentLoaded", function () {
      const applyBtn = document.getElementById('applyBtn');
      applyBtn.addEventListener('click', function () {
        document.getElementById("modal").classList.add("show");
      });
    });
    
  </script>
<script>
  document.querySelector(".modal-form").addEventListener("submit", function (e) {
    e.preventDefault(); // جلوگیری از ارسال پیش‌فرض فرم

    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('.submit-btn');
    const messageBox = document.getElementById("messageBox");

    // ریست پیام قبلی
    messageBox.style.display = "none";
    messageBox.classList.remove("error");
    messageBox.textContent = "";

    submitBtn.disabled = true;
    submitBtn.textContent = "در حال ارسال...";

    fetch("submit_resume.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(response => {
      messageBox.style.display = "block";
      messageBox.textContent = response.trim();

      if (response.includes("با موفقیت")) {
        form.reset();
        messageBox.classList.remove("error");

        setTimeout(() => {
          document.getElementById("modal").classList.remove("show");
          messageBox.style.display = "none";
        }, 2500);
      } else {
        messageBox.classList.add("error"); // نمایش به صورت قرمز
      }
    })
    .catch(error => {
      messageBox.style.display = "block";
      messageBox.classList.add("error");
      messageBox.textContent = "خطا در ارسال اطلاعات. لطفاً دوباره تلاش کنید.";
      console.error(error);
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.textContent = "ارسال رزومه";
    });
  });
</script>

</body>
</html>
