<?php
session_start();
include '../../database/db.php';

// دریافت id مقاله از URL
$id = intval($_GET['id']);

// چک کردن وجود مقاله
$selectblog = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$selectblog->bindValue(1, $id, PDO::PARAM_INT);
$selectblog->execute();
$blogs = $selectblog->fetchAll(PDO::FETCH_ASSOC);

if (!$blogs) {
    die('مقاله‌ای با این شناسه یافت نشد.');
}
// پردازش فرم ارسال نظر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userid = htmlspecialchars(trim($_POST['userid']));
    $text = htmlspecialchars(trim($_POST['text']));
  $user_email = $_SESSION['user_email'];

    // بررسی اینکه فیلدها خالی نباشند
    if (!empty($userid) && !empty($text)) {
        $coment = $conn->prepare("INSERT INTO coment (post, userid, text , user_email) VALUES (?, ?, ? , ?)");
        $coment->bindValue(1, $id, PDO::PARAM_INT);
        $coment->bindValue(2, $userid, PDO::PARAM_STR);
        $coment->bindValue(3, $text, PDO::PARAM_STR);
        $coment->bindValue(4, $user_email, PDO::PARAM_STR);
        $coment->bindValue(4, $user_email, PDO::PARAM_STR);
        $coment->execute();

        // پیام موفقیت
        $_SESSION['message'] = 'نظر شما با موفقیت ثبت شد.';
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
    } else {
        $_SESSION['error'] = 'لطفاً تمام فیلدها را پر کنید.';
    }
}

// انتخاب نظرات مرتبط با مقاله
$select = $conn->prepare("SELECT * FROM coment WHERE post = ? ORDER BY id DESC");
$select->bindValue(1, $id, PDO::PARAM_INT);
$select->execute();
$comnts = $select->fetchAll(PDO::FETCH_ASSOC);

foreach ($blogs as $b) {
    $tagss = explode(',', $b['tags']);
}
?>

<!DOCTYPE html>
<html lang="fa">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blogs[0]['title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./comment.css">
    <link rel="shortcut icon" href="../../tasavir/Untitled-2.png" type="image/x-icon">
    <style>
        .error { color: red; }
        .success { color: green; }
        .comment-form { margin-top: 20px; }
        .comment { border-bottom: 1px solid #ccc; padding: 10px 0; }
       .image{
        display: flex;
justify-content: center;   

 }
 .image>img{
  width: 800px;
  height: 400px;
 }
 textarea{
  height: 200px;
 }
    </style>
     <style>img:is([sizes="auto" i], [sizes^="auto," i]) { contain-intrinsic-size: 3000px 1500px }</style>
	<style id="wp-emoji-styles-inline-css" type="text/css">

	img.wp-smiley, img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
    *{
        font-family: iranSans !important;
    }
</style>
<style id="safe-svg-svg-icon-style-inline-css" type="text/css">
.safe-svg-cover{text-align:center}.safe-svg-cover .safe-svg-inside{display:inline-block;max-width:100%}.safe-svg-cover svg{height:100%;max-height:100%;max-width:100%;width:100%}

</style>
<style id="classic-theme-styles-inline-css" type="text/css">
/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
</style>
<link rel="stylesheet" id="simple-image-popup-css" href="../../srcfiles/simple-image-popup.css" type="text/css" media="all">
<script type="text/javascript" src="../../srcfiles/jquery.js" id="jquery-js"></script>
<!-- <link rel="https://api.w.org/" href="https://ravinacademy.com/wp-json/"><link rel="alternate" title="JSON" type="application/json" href="https://ravinacademy.com/wp-json/wp/v2/pages/73"><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://ravinacademy.com/xmlrpc.php?rsd"> -->

<!-- <link rel="canonical" href="https://ravinacademy.com/">
<link rel="shortlink" href="https://ravinacademy.com/"> -->
<!-- <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://ravinacademy.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fravinacademy.com%2F">
<link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://ravinacademy.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fravinacademy.com%2F&amp;format=xml"> -->
<link rel="stylesheet" href="../../srcfiles/classic.css"><link rel="stylesheet" href="../../srcfiles/style.7a857bdd.css">	<link rel="stylesheet" as="style" href="../../srcfiles/font.css" onload="this.onload=null;this.rel='stylesheet'">
	<!-- <link rel="icon" href="https://ravinacademy.com/wp-content/uploads/2024/01/favicon.png" sizes="32x32"> -->
<!-- <link rel="icon" href="https://ravinacademy.com/wp-content/uploads/2024/01/favicon.png" sizes="192x192"> -->
<!-- <link rel="apple-touch-icon" href="https://ravinacademy.com/wp-content/uploads/2024/01/favicon.png"> -->
<!-- <meta name="msapplication-TileImage" content="https://ravinacademy.com/wp-content/uploads/2024/01/favicon.png"> -->
		<style type="text/css" id="wp-custom-css">
			figure table tbody tr td, table, td {
border: 1px solid #d2d2d2;
padding: 15px;
}
th.has-text-align-center, thead {
border: 1px solid #d2d2d2;
padding: 15px;
}
table {
	width: -webkit-fill-available;
}
code {
	  background: #f4f4f4;
    border: 1px solid #ddd;
    border-left: 3px solid #262626!important;
    color: #666;
    page-break-inside: avoid;
    font-family: monospace;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 1.6em;
    max-width: 100%;
    overflow: auto;
    padding: 1em 1.5em;
    display: block;
    word-wrap: break-word;
}
thead:first-child {
    background-color: #d2d2d2;
}
th.has-text-align-center {
    border-left-color: #fff;
}
.post-content.figure-img-m-auto.basis-full.lg\:basis-8\/12.text-lg.font-serif.pt-0 {
    overflow: hidden;
}
figure.wp-block-table {
overflow: scroll;
}
td.has-text-align-right {
    width: 50% !important;
}
img.aligncenter {
    margin: 0 auto;
}
.simple-image-popup-plugin__inner, .simple-image-popup-plugin__image {
	border-radius: 15px;
}
tr.row-1.odd {
    background-color: #d8d8d8;
}
.tracking-wide {
    letter-spacing: 0px!important;
}		</style>
		
	<link rel="stylesheet" href="../../srcfiles/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<!-- <link rel="stylesheet" href="https://ravinacademy.com/wp-content/themes/ravinacademy/assets/css/aos-noscripy.css "> -->
	</noscript>
<style id="safe-svg-svg-icon-style-inline-css" type="text/css">
.safe-svg-cover{text-align:center}.safe-svg-cover .safe-svg-inside{display:inline-block;max-width:100%}.safe-svg-cover svg{height:100%;max-height:100%;max-width:100%;width:100%}

</style>
<style id="classic-theme-styles-inline-css" type="text/css">
/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
</style>
<link rel="stylesheet" id="simple-image-popup-css" href="../../srcfiles/simple-image-popup.css" type="text/css" media="all">
<script type="text/javascript" src="../../srcfiles/jquery.js" id="jquery-js"></script>


<link rel="stylesheet" href="../../srcfiles/classic.css"><link rel="stylesheet" href="../../srcfiles/style.7a857bdd.css">	<link rel="stylesheet" as="style" href="../../srcfiles/font.css" onload="this.onload=null;this.rel='stylesheet'">

		<style type="text/css" id="wp-custom-css">
			figure table tbody tr td, table, td {
border: 1px solid #d2d2d2;
padding: 15px;
}
th.has-text-align-center, thead {
border: 1px solid #d2d2d2;
padding: 15px;
}
table {
	width: -webkit-fill-available;
}
code {
	  background: #f4f4f4;
    border: 1px solid #ddd;
    border-left: 3px solid #262626!important;
    color: #666;
    page-break-inside: avoid;
    font-family: monospace;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 1.6em;
    max-width: 100%;
    overflow: auto;
    padding: 1em 1.5em;
    display: block;
    word-wrap: break-word;
}
thead:first-child {
    background-color: #d2d2d2;
}
th.has-text-align-center {
    border-left-color: #fff;
}
.post-content.figure-img-m-auto.basis-full.lg\:basis-8\/12.text-lg.font-serif.pt-0 {
    overflow: hidden;
}
figure.wp-block-table {
overflow: scroll;
}
td.has-text-align-right {
    width: 50% !important;
}
img.aligncenter {
    margin: 0 auto;
}
.simple-image-popup-plugin__inner, .simple-image-popup-plugin__image {
	border-radius: 15px;
}
tr.row-1.odd {
    background-color: #d8d8d8;
}
.tracking-wide {
    letter-spacing: 0px!important;
}		</style>


</head>
<body style="background-color: rgba(0, 0, 0, 0.05);">


    <div class="container" dir="rtl">
        <?php foreach ($blogs as $blog): ?>
            <h1><?= $blog['title'] ?></h1>
            <img src="../../uploads/<?= $blog['image'] ?>" alt="تصویر مقاله" class="article-image">
            <p><p> <?= $caption = str_replace('../uploads/', '../../uploads/', $blog['caption']);
     $caption;
    ?></p>
            </p>
            <h2>برچسب‌ها</h2>
            <?php foreach ($tagss as $tags): ?>
                <span>#<?= htmlspecialchars($tags) ?></span>
            <?php endforeach; ?>
            <p class="nevisande"> نویسنده: <?= htmlspecialchars($blog['writer']) ?></p>
            <p class="nevisande"> تاریخ انتشار: <?= htmlspecialchars($blog['date']) ?></p>
        <?php endforeach; ?>
<div class="secCom">
  <a href="../maqale.php"><button class="read-more">بازگشت</button></a>
  <?php if (isset($_SESSION['user_email'])):?>
<div style="text-align: center; margin-top: 20px;">
  <form action="../../pdf.php" method="post" target="_blank">
      <input type="hidden" name="blog_id" value="<?= htmlspecialchars($id) ?>">
      <button dir="rtl" type="submit" class="download-pdf down"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: var(--text-color)"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg> <p>دانلود این مقاله با فرمت pdf</p></button>
  </form>
</div>
<?php else:?>
<div class="not-login">
<a  target="_blank" href="../../login/login.php"><button id="login-pdf" class="down" >برای دانلود مقاله باید ورود کنید</button></a>

</div> 
<?php endif;?>

</div>
        

        
      
     
    </div>
    <div class="coment-body">
            <div class="comments-section">
                <h2>نظرات</h2>
        <?php if (isset($_SESSION['user_email'])):?>
                <?php if (isset($_SESSION['message'])): ?>
                    <p class="success"><?= $_SESSION['message'] ?></p>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error"><?= $_SESSION['error'] ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form class="comment-form" method="post" dir="rtl">
                    <input type="text" name="userid" placeholder="نام خود را وارد کنید..." required>
                    <textarea name="text" placeholder="نظر خود را اینجا بنویسید..." required></textarea>
                    <button type="submit" name="submit">ارسال نظر</button>
                </form>


                <?php else:?>
                  <h4> <a style="text-decoration: none;"  href="../../login/login.php">برای ثبت نظر ورود کنید </a></h4>
                <?php endif;?>


                <div id="comments-list">
                    <?php foreach ($comnts as $co): ?>
                        <div class="comment">
                            <p class="comName"><strong> نام:<?= htmlspecialchars($co['userid']) ?> </p>
                            
                            <p class="comText"></strong> نظر:<?= nl2br(htmlspecialchars($co['text'])) ?> </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <script src="script.js"></script>
<script src="../../script.js"></script>
<!-- <script src="../../darkmode.js"></script> -->

</body>
</html>
