<?php 
session_start();
include '../database/db.php';

// واکشی تگ‌ها از جدول blogs
$query = $conn->prepare("SELECT DISTINCT tags FROM blogs");
$query->execute();
$tags = $query->fetchAll(PDO::FETCH_COLUMN);

// ترکیب تمام تگ‌ها به صورت آرایه
$categories = [];
foreach ($tags as $tagList) {
    $categories = array_merge($categories, explode(',', $tagList));
}

// حذف مقادیر تکراری و مرتب‌سازی تگ‌ها
$categories = array_unique(array_map('trim', $categories));
sort($categories);

// دریافت تگ انتخابی از پارامتر GET
$current_category = isset($_GET['tag']) ? $_GET['tag'] : 'همه';

// فیلتر مقالات بر اساس تگ انتخاب شده
if ($current_category === 'همه') {
    // اگر تگ "همه" انتخاب شد، همه مقالات را نمایش می‌دهیم
    $query = $conn->prepare("SELECT * FROM blogs");
} else {
    // در غیر این صورت، مقالاتی که تگ انتخابی را دارند، فیلتر می‌کنیم
    $query = $conn->prepare("SELECT * FROM blogs WHERE FIND_IN_SET(:tag, tags)");
    $query->bindParam(':tag', $current_category, PDO::PARAM_STR);
}
// اجرای کوئری
$query->execute();
$blogs = $query->fetchAll(PDO::FETCH_ASSOC);

// دیباگ: نمایش تعداد مقالات پیدا شده
// فیلتر مقالات بر اساس تگ انتخاب شده
if ($current_category === 'همه') {
    // اگر تگ "همه" انتخاب شد، همه مقالات را نمایش می‌دهیم
    $query = $conn->prepare("SELECT * FROM blogs");
} else {
    // در غیر این صورت، مقالاتی که تگ انتخابی را دارند، فیلتر می‌کنیم
    $query = $conn->prepare("SELECT * FROM blogs WHERE tags LIKE :tag");
    $query->bindValue(':tag', '%' . $current_category . '%', PDO::PARAM_STR);
}
$query->execute();
$blogs = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <!-- <link rel="stylesheet" href="../mobile2.css"> -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="st.css">
    <link rel="stylesheet" href="risponse.css">
    <link rel="shortcut icon" href="../tasavir/Untitled-2.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقالات</title>
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
<link rel="stylesheet" id="simple-image-popup-css" href="../srcfiles/simple-image-popup.css" type="text/css" media="all">
<script type="text/javascript" src="../srcfiles/jquery.js" id="jquery-js"></script>
<!-- <link rel="https://api.w.org/" href="https://ravinacademy.com/wp-json/"><link rel="alternate" title="JSON" type="application/json" href="https://ravinacademy.com/wp-json/wp/v2/pages/73"><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://ravinacademy.com/xmlrpc.php?rsd"> -->

<!-- <link rel="canonical" href="https://ravinacademy.com/">
<link rel="shortlink" href="https://ravinacademy.com/"> -->
<!-- <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://ravinacademy.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fravinacademy.com%2F">
<link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://ravinacademy.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fravinacademy.com%2F&amp;format=xml"> -->
<link rel="stylesheet" href="../srcfiles/classic.css"><link rel="stylesheet" href="../srcfiles/style.7a857bdd.css">	<link rel="stylesheet" as="style" href="../srcfiles/font.css" onload="this.onload=null;this.rel='stylesheet'">
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
		
	<link rel="stylesheet" href="../srcfiles/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
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
<link rel="stylesheet" id="simple-image-popup-css" href="../srcfiles/simple-image-popup.css" type="text/css" media="all">
<script type="text/javascript" src="../srcfiles/jquery.js" id="jquery-js"></script>


<link rel="stylesheet" href="../srcfiles/classic.css"><link rel="stylesheet" href="../srcfiles/style.7a857bdd.css">	<link rel="stylesheet" as="style" href="../srcfiles/font.css" onload="this.onload=null;this.rel='stylesheet'">

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
<body class="overflow-x-hidden flex flex-col items-center rtl home page-template page-template-templates page-template-templates-home page-template-templatestemplates-home-php page page-id-73" data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php
require_once('./header-maqale.php');
?>

<div class="categories">
    <div class="cats cats1">
        <div class="cat cat1"><a href="?tag=همه">همه</a></div>
        <?php foreach ($categories as $category): ?>
            <div class="cat">
                <a href="?tag=<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cats cats2">
            <a href="../index.php" class="cat cat6"><p>بازگشت</p> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: var(--base-color)"><path d="m5 12 7 6v-5h6v-2h-6V6z"></path></svg></a>

        </div>
</div>

<div class="blogs block">
        <?php function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
} foreach ($blogs as $blog): 


    $rowcoment = $conn->prepare("SELECT COUNT(*) FROM coment WHERE post = ? ");
    $rowcoment->bindValue(1, $blog['id'], PDO::PARAM_INT);
    $rowcoment->execute();
    $count = $rowcoment->fetchColumn(); // استفاده از fetchColumn برای شمارش
    
?>
             <div class="blog">
                <img src="../uploads/<?= ($blog['image']) ?>" alt="تصویر مقاله" class="article-image">
             <h2>  <a href="blog/index.php?id=<?=$blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2> 
                <div class="discreption">
                    <?php
                     

                     
                     
                     
                     $content = $blog['caption'];
                     
                     
                     echo   limit_words($content,5); 
                     
                     ?>
                </div>
                <div class="catSec">

                    <div class="writer">
                        نویسنده: <?= htmlspecialchars($blog['writer']) ?>
                    </div>

                    <div class="categ"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path d="M11 10H9v3H6v2h3v3h2v-3h3v-2h-3z"></path><path d="M4 22h12c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2zM4 8h12l.002 12H4V8z"></path><path d="M20 2H8v2h12v12h2V4c0-1.103-.897-2-2-2z"></path></svg> <p><?= $blog['tags']?></p>  </div>

                </div>
                <div class="iconsSec">

                    <div class="icons">
                    <div class="like icon like-button" id="like-button-0">
       <p id="like-count-0"> 0 </p> 
       <svg id="like-icon-0"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
           <path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"/>
       </svg>
       <svg id="liked-icon-0" xmlns="http://www.w3.org/2000/svg" fill="red" width="24" height="24" viewBox="0 0 24 24" style="display: none;">
           <path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path>
       </svg>
    </div>
    
    
    
    
    
    
    
    
    <div class="comment icon"><?=$count ?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style=";transform: ;msFilter:;"><path d="M20 2H4c-1.103 0-2 .897-2 2v18l5.333-4H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14H6.667L4 18V4h16v12z"></path><circle cx="15" cy="10" r="2"></circle><circle cx="9" cy="10" r="2"></circle></svg></div>
                    </div>
                    <div class="save icons">
    <div class="saveIcon icon" data-id="<?= $blog['id'] ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M18 2H6c-1.103 0-2 .897-2 2v18l8-4.572L20 22V4c0-1.103-.897-2-2-2zm0 16.553-6-3.428-6 3.428V4h12v14.553z"></path>
        </svg>
    </div>
    <div class="savedIcon icon" data-id="<?= $blog['id'] ?>" style="display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"></path>
        </svg>
    </div>
</div>

<script>
    // گرفتن همه آیکون‌های ذخیره و ذخیره‌شده
    const saveIcons = document.querySelectorAll('.saveIcon');
    const savedIcons = document.querySelectorAll('.savedIcon');

    // به‌روزرسانی وضعیت آیکون‌ها بر اساس localStorage
    function updateIcons() {
        saveIcons.forEach(saveIcon => {
            const articleId = saveIcon.dataset.id;
            const isSaved = localStorage.getItem(`isSaved-${articleId}`) === 'true';
            const savedIcon = document.querySelector(`.savedIcon[data-id="${articleId}"]`);

            if (isSaved) {
                saveIcon.style.display = "none";
                savedIcon.style.display = "flex";
            } else {
                saveIcon.style.display = "flex";
                savedIcon.style.display = "none";
            }
        });
    }

    // به‌روزرسانی وضعیت آیکون‌ها در بارگذاری صفحه
    updateIcons();

    // افزودن رویداد به هر آیکون ذخیره
    saveIcons.forEach(saveIcon => {
        const articleId = saveIcon.dataset.id;
        const savedIcon = document.querySelector(`.savedIcon[data-id="${articleId}"]`);

        saveIcon.addEventListener("click", () => {
            saveIcon.style.display = "none";
            savedIcon.style.display = "flex";
            localStorage.setItem(`isSaved-${articleId}`, 'true'); // ذخیره وضعیت
        });

        savedIcon.addEventListener("click", () => {
            savedIcon.style.display = "none";
            saveIcon.style.display = "flex";
            localStorage.setItem(`isSaved-${articleId}`, 'false'); // ذخیره وضعیت
        });
    });
</script>
                </div>
                
                <a href="blog/index.php?id=<?=$blog['id'] ?>">
                <div class="view">مشاهده</div>
                 </a>
                
            </div>
        <?php endforeach; ?>
      
    </div>
      
<script src="script.js"></script>
    <script src="save.js"></script>
    <!-- <script src="../darkmode.js"></script> -->
    <script src="../script.js"></script>
</body>
</html>
