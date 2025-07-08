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
<body class="overflow-x-hidden flex flex-col items-center rtl home page-template page-template-templates page-template-templates-home page-template-templatestemplates-home-php page page-id-73" data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0" style="background-color: rgba(0, 0, 0, 0.1);">

<?php
// require_once('./header-maqale.php');
?>

<div class="categories">
  <div class="cats cats1" id="cats1">
    <div class="cat cat1"><a href="?tag=همه">همه</a></div>
    <?php foreach ($categories as $category): ?>
      <div class="cat">
        <a href="?tag=<?= htmlspecialchars($category) ?>">
          <?= htmlspecialchars($category) ?>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="cats cats2">
    <a href="../index.php" class="cat cat6">
      <p>بازگشت</p>
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: var(--base-color)">
        <path d="m5 12 7 6v-5h6v-2h-6V6z"></path>
      </svg>
    </a>
  </div>
</div>
<script>
    const sliderY = document.getElementById('cats1');
let isDragging = false;
let startX, startScroll;

/* بررسی اینکه اسکرول در ابتدا یا انتها باشه */
function atEdge() {
  return sliderY.scrollLeft === 0
      || sliderY.scrollLeft >= sliderY.scrollWidth - sliderY.clientWidth;
}

/* شروع درگ با pointer events */
// sliderY.addEventListener('pointerdown', e => {
//   if (!atEdge()) return;            // فقط وقتی در لبه‌ایم
//   isDragging = true;
//   startX = e.clientX;
//   startScroll = sliderY.scrollLeft;
//   sliderY.setPointerCapture(e.pointerId);
//   sliderY.style.cursor = 'grabbing';
// });



sliderY.addEventListener('pointermove', e => {
  if (!isDragging) return;
  const delta = e.clientX - startX;
  sliderY.scrollLeft = startScroll - delta;
});

sliderY.addEventListener('pointerup', e => {
  isDragging = false;
  sliderY.releasePointerCapture(e.pointerId);
  sliderY.style.cursor = 'grab';
});

sliderY.addEventListener('pointerleave', () => {
  isDragging = false;
  sliderY.style.cursor = 'grab';
});
</script>

<div class="flex w-full" style=" transition-duration: 0ms;  align-items: center; justify-content: center; flex-wrap:wrap;">


<?php
 function limit_words($string, $word_limit)
{
$words = explode(" ",$string);
return implode(" ",array_splice($words,0,$word_limit));
} foreach ($blogs as $blog): 


$rowcoment = $conn->prepare("SELECT COUNT(*) FROM coment WHERE post = ? ");
$rowcoment->bindValue(1, $blog['id'], PDO::PARAM_INT);
$rowcoment->execute();
$count = $rowcoment->fetchColumn(); // استفاده از fetchColumn برای شمارش

?>                       
<article id="post-1936" class="course-item transition select-none duration-500 hover:-translate-y-2 swiper-slide ml-6 md:ml-7 2xl:ml-8 last:ml-0 w-[275px] transition-all" data-filter="blue-path" style="margin-top: 1rem;">
                <a class="hover:text-black active:text-black" href="blog/index.php?id=<?=$blog['id'] ?>" rel="bookmark" style="cursor:pointer">
                    <div class="overflow-hidden bg-white rounded-2xl w-full md:w-[275px]">
                        <div class="relative bg-white pt-[63%] rounded-xl overflow-hidden m-1.5">
                            
                            <img  src="../uploads/<?= ($blog['image']) ?>" style="position: absolute;" class="rounded-lg left-0 right-0 top-0 bottom-0 m-auto object-cover" alt="SOC Tier 1 Operations Zero to Hero" decoding="async" fetchpriority="high"  sizes="(max-width: 736px) 1vw, 736px">                                        </div>

                     
                      

                        <header class=" border-b border-black border-opacity-5 pb-3">
                            <h2 dir="ltr" class="px-3 text-lg font-medium font-serif text-center mb-1 pt-0 leading-5 h-10 2xl:leading-6 2xl:h-12 overflow-hidden">
                            <a href="./blog/index.php?id=<?=$blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></h2>
                            <ul class="px-3 flex flex-wrap pb-2 text-xs text-gray-500 font-light items-center justify-center">
                            <?php
     

     
     
     
     $content = $blog['caption'];
     
     
     echo   limit_words($content,4); 
     
     ?>
                                                        
</li>
                            </ul>
                                                        
    
                                                        
                                                        
<div class="price flex justify-center items-center leading-5 h-5">
<div class="categ"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path d="M11 10H9v3H6v2h3v3h2v-3h3v-2h-3z"></path><path d="M4 22h12c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2zM4 8h12l.002 12H4V8z"></path><path d="M20 2H8v2h12v12h2V4c0-1.103-.897-2-2-2z"></path></svg> <p><?= $blog['tags']?></p>  </div>
                                        </div>
                                                        
                                                        
                        </header>

                        <footer class="flex items-center justify-between py-0.5 px-3" style="background-color: unset;">
                            <div class="group btn border-transparent px-0 mr-auto">
                                <span class="font-medium text-sm font-serif pt-1">
<a href="./blog/index.php?id=<?=$blog['id'] ?>">
<div class="view">مشاهده</div>
 </a></span>
                                <svg class="group-hover:-translate-x-0.5 transition duration-300 mr-3 w-2.5 h-2.5 lg:w-3 lg:h-3">
                                    <use href="#icon-btn-arrow"></use>
                                </svg>
                            </div>
                        </footer>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>     
                                            </div>
      
<script src="script.js"></script>
    <script src="save.js"></script>
    <!-- <script src="../darkmode.js"></script> -->
    <script src="../script.js"></script>
</body>
</html>
