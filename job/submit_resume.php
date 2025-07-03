<?php
// چک کردن که آیا درخواست از طریق POST است یا نه (یعنی درخواست از فرم است)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // اگر درخواست از طریق GET یا روش‌های دیگر باشد، فایل را مسدود می‌کنیم
    http_response_code(403); // ارسال کد خطای 403 (دسترسى ممنوع)
    die('دسترسی به این فایل مجاز نیست.');
}

// ادامه کد ارسال رزومه
require_once '../database1/db.php';

if (
  empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone']) ||
  empty($_POST['jobTitle']) || empty($_POST['military_status']) || !isset($_FILES['resume'])
) {
  echo "لطفاً همه فیلدها را کامل کنید.";
  exit;
}

$fullname = $_POST['fullname'];
$national_code = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['jobTitle'];
$work_experience = $_POST['coverLetter'] ?? '';
$military_status = $_POST['military_status'];
$job_id = (int)$_POST['job_id'];

$resume = $_FILES['resume'];
$uploadDir = '../uploads/resume/';
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0775, true); // ساخت پوشه در صورت نبود
}

$resumeName = time() . '_' . basename($resume['name']);
$uploadPath = $uploadDir . $resumeName;

if (!move_uploaded_file($resume['tmp_name'], $uploadPath)) {
  echo "آپلود فایل ناموفق بود.";
  exit;
}

try {
  $stmt = $conn->prepare("INSERT INTO resumes 
    (job_id, fullname, national_code, phone, address, resume_file, work_experience, military_status) 
    VALUES (:job_id, :fullname, :national_code, :phone, :address, :resume_file, :work_experience, :military_status)");

  $stmt->execute([
    'job_id' => $job_id,
    'fullname' => $fullname,
    'national_code' => $national_code,
    'phone' => $phone,
    'address' => $address,
    'resume_file' => $resumeName,
    'work_experience' => $work_experience,
    'military_status' => $military_status,
  ]);

  echo "رزومه شما با موفقیت ارسال شد.";
} catch (Exception $e) {
  echo "خطا در ذخیره اطلاعات. لطفاً دوباره تلاش کنید.";
}
?>
