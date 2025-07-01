<?php
// اتصال به دیتابیس
// اتصال به دیتابیس از طریق db.php
include 'database/db.php'; // مسیر فایل db.php

// ایجاد اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// بررسی اینکه آیا فرم ارسال شده است
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت اطلاعات فرم
    $name = $_POST['name'];
    $email = $_POST['email'];
    $project_type = $_POST['project-type'];
    $details = $_POST['details'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];

    // درج اطلاعات به دیتابیس
    $sql = "INSERT INTO orders (name, email, project_type, details, budget, deadline) 
            VALUES ('$name', '$email', '$project_type', '$details', '$budget', '$deadline')";

    if ($conn->query($sql) === TRUE) {
        $message = "سفارش شما با موفقیت ثبت شد!";
    } else {
        $message = "خطا در ثبت سفارش: " . $conn->error;
    }
}

// بستن اتصال به دیتابیس
$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارش پروژه طراحی سایت</title>
    <style>
        @font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bolder;
  src: url(yekan/Yekan-Bakh-FaNum-07-Heavy.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bold;
  src: url(yekan/Yekan-Bakh-FaNum-06-Bold.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 900;
  src: url(yekan/Yekan-Bakh-FaNum-08-Fat.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 700;
  src: url(yekan/Yekan-Bakh-FaNum-05-Medium.woff);
}



@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 300;
  src: url(yekan/Yekan-Bakh-FaNum-04-Regular.woff);
}

        * {
            font-family: iranSans;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            
            background-color: #f5f5f5;
            direction: rtl;
            margin: 0;
            padding: 0;
            overflow-x: hidden!important;
        }

/* افکت گرادیانت متحرک برای header */
@keyframes headerGradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

header {
  background: linear-gradient(270deg, rgb(25, 25, 25), rgb(50, 50, 50));
  background-size: 400% 400%;
  animation: headerGradient 8s ease infinite;
  color: white;
  padding: 20px;
  text-align: center;
  border-bottom: 2px solid rgb(255, 255, 255);
}

h1 {
  font-size: 36px;
  margin: 0;
}

.container {
  width: 80%;
  margin: 30px auto;
}

/* فرم کانتینر با افکت هاور انیمیشنی */
.form-container {
  background-color: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}
.stepsSec{
  display: flex;
  flex-direction: column;
  align-items: center;
}

.step-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 40px;
  gap: 0px;
  position: relative;
  margin-left: 1rem;
  max-width: 920px;
  width: 100%;
}

.step:first-child {
  border-radius: 0 20px 20px 0;
}
.step:last-child {
  border-radius: 20px 0px 0px 20px;
}

/* افکت پالس برای مرحله فعال */
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(60, 217, 114, 0.7); }
  70% { box-shadow: 0 0 0 10px transparent; }
  100% { box-shadow: 0 0 0 0 rgba(60, 217, 114, 0.7); }
}
.active-step {
    color: white !important;
  background-color: rgb(38, 40, 40);
  animation: pulse 2s infinite;
}

.step {
  z-index: 1;
  position: relative;
  width: 25%;
  text-align: center;
  padding: 10px;
  font-size: 18px;
  border: 5px solid rgb(38, 40, 40);
  color: rgb(38, 40, 40);
  min-width: 50px;
  transition: background-color 0.3s ease, transform 0.3s ease;
}


.lamp {
  position: absolute;
  right: 40%;
  top: -49px;
  z-index: 100;
  animation: lampGlow 3s ease-in-out infinite alternate;
}
@keyframes lampGlow {
  from { filter: brightness(1); }
  to { filter: brightness(1.2); }
}

.cable {
  position: absolute;
  right: 57%;
  top: -53px;
  height: 50px;
  width: 88%;
  animation: cableSwing 4s ease-in-out infinite;
}
@keyframes cableSwing {
  0% { transform: rotate(0deg); }
  50% { transform: rotate(2deg); }
  100% { transform: rotate(0deg); }
}

#cable1 {
  z-index: 10;
}
#cable2 {
  z-index: 10;
}
#cable3 {
  z-index: 10;
}
.rotCable {
  transform: rotate(180deg);
}

#step1 {
  border-left: unset;
}
#step2 {
  border-left: unset;
  border-right: unset;
}
#step3 {
  border-left: unset;
  border-right: unset;
}
#step4 {
  border-right: unset;
}

@media screen and (max-width:770px) {
  .step:first-child {
    border-radius: 20px 20px 0 0;
  }
  .step:last-child {
    border-radius: 0 0 20px 20px;
  }
  .form-container {
    flex-direction: row;
  }
  .form-group button {
    font-size: 12px!important;
  }
  .lamp {
    position: absolute;
    right: -38px;
    top: 6px;
    transform: rotate(90deg);
    width: 35px;
  }
  .cable {
    display: none;
  }
  .step {
    border: 5px solid rgb(38, 40, 40);
  }
  #step1 {
    border-bottom: unset;
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step2 {
    border-bottom: unset;
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step3 {
    border-bottom: unset;
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
    border-left: 5px solid rgb(38, 40, 40);
  }
  #step4 {
    border-top: unset;
    border-right: 5px solid rgb(38, 40, 40);
  }
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  font-size: 18px;
  color: #333;
  margin-bottom: 8px;
  display: block;
}

.form-group input,
.form-group textarea,
.form-group select {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 5px;
  transition: border-color 0.3s ease;
}
.form-group input:hover,
.form-group textarea:hover,
.form-group select:hover {
  border-color: #3cd972;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
  border-color: #3cd972;
  outline: none;
}

.form-group button {
  background-color: rgb(38, 40, 40);
  color: white;
  padding: 10px 15px;
  font-size: 18px;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  margin-top: 0.4rem;
  transition: background-color 0.3s ease, transform 0.3s ease;
}
.form-group button:hover {
  background-color: #3cd972;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(60, 217, 114, 0.3);
}

.footer {
  background-color: #333;
  color: white;
  text-align: center;
  padding: 15px;
  margin-top: 40px;
}

footer a {
  color: #3cd972;
  text-decoration: none;
  font-weight: bold;
}
footer a:hover {
  text-decoration: underline;
}

/* Mobile responsive design */
@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  header h1 {
    font-size: 28px;
  }
  .step-container {
    flex-direction: column;
  }
  .boxes {
    flex-direction: column;
  }
  #graphCat {
    margin-top: -2rem;
  }
}

.boxes {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.3rem;
}
.catBox {
  padding: 0.2rem 0.8rem;
  text-align: center;
  background-color: #333;
  border-radius: 12px;
  transition: all 0.2s ease-out;
  font-size: x-large;
  color: #f5f5f5;
  margin-bottom: 2rem;
  cursor: pointer;
}
.catBox:hover {
  transform: translateY(-3px);
}


/* Mobile responsive design */
@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  header h1 {
    font-size: 28px;
  }
  .step-container {
    flex-direction: column;
  }
  .boxes {
    flex-direction: column;
  }
  #graphCat {
    margin-top: -2rem;
  }
  #testCat {
    margin-top: -2rem;
  }
}

.boxes {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.3rem;
 margin-top: 0.3rem;
}
.catBox {
  padding: 0.2rem 0.8rem;
  text-align: center;
  background-color: #333;
  border-radius: 12px;
  transition: all 0.2s ease-out;
  font-size: x-large;
  color: #f5f5f5;
  margin-bottom: 2rem;
  cursor: pointer;
 
}
.catBox:hover {
  transform: translateY(-3px);
}
.activeBox {
  background-color: #3cd972;
  transform: translateY(-1px);
}

form {
  position: relative;
  min-height: 500px;       /* حداقل ارتفاع فرم */
  padding-bottom: 40px;    /* فضای کافی برای دکمه‌ها */
}

.steps-wrapper {
  overflow: hidden;        /* مخفی کردن مراحل غیرفعال */
  position: relative;
}


/* نمایش مرحله‌ی فعال */


/* استایل ثابت باکس دکمه‌ها */
.formButtons {
  display: flex;
  position: absolute;
  bottom: 100px;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  width: 100%;
  z-index: 10;            
  min-width: 250px;
}

.formButtons button {
  margin: 0 8px;
  padding: 10px 20px;
  cursor: pointer;
}


    </style>
</head>
<body>

    <header>
        <h1>سفارش پروژه  </h1>
    </header>

    <div class="container">
      
        <div class="form-container">
            <?php if (isset($message)): ?>
                <p style="color: green; font-size: 18px; text-align: center;"><?php echo $message; ?></p>
            <?php endif; ?>
            
            <div class="stepsSec">
           
            <div class="step-container">
                <div class="step active-step" id="step1"> 1
                    <img id="lampOff1" style="display:none;" class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                    <img id="lampOn1" class="lamp lampOn"  src="tasavir/lampOn.png" alt="" width="50px">
                    
                </div>
               
                <div class="step" id="step2"> 2
                <img id="lampOff2" class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img id="lampOn2" style="display:none;" class="lamp lampOn"  src="tasavir/lampOn.png" alt="" width="50px">
                

                </div>
                <div class="step" id="step3"> 3
                <img id="lampOff3"  class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img id="lampOn3" style="display:none;" class="lamp lampOn"  src="tasavir/lampOn.png" alt="" width="50px">
               

                </div>
                <div class="step" id="step4"> 4
                <img id="lampOff4"   class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img id="lampOn4" style="display:none;" class="lamp lampOn"  src="tasavir/lampOn.png" alt="" width="50px">
                </div>
            </div>
              </div>
            <form method="POST">
                <!-- Step 1 -->
                <div id="step-1">
                   <div class="steps-wrapper">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    </div>
                    <div class="form-group formButtons">
                        <button type="button" id="next1">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" style="display: none;">
                  
<div class="steps-wrapper">
                    <div class="boxes">
                        <div id="webCat" class="catBox activeBox">وبسایت</div>
                        <div id="graphCat" class="catBox">گرافیک</div>
                        <div id="testCat" class="catBox">تست نفوذ</div>
                    </div>





                    <div id="webForm" class="form-group">
                        <label for="project-type">نوع پروژه:</label>
                        <select id="project-type" name="project-type" required>
                            <option value="">انتخاب نشده</option>
                            <option value="website">وبسایت</option>
                            <option value="ecommerce">فروشگاه اینترنتی</option>
                            <option value="webAplication">وب اپلیکیشن</option>
                            <option value="other"> سایر...  </option>
                        </select>
                    </div>
                    <div id="graphForm" class="form-group" style="display: none;">
                        <label for="project-type">نوع پروژه:</label>
                        <select id="project-type" name="project-type" required>
                            <option value="">انتخاب نشده</option>
                            <option value="poster">پوستر</option>
                            <option value="banner"> بنر</option>
                            <option value="social">سوشال مدیا </option>
                            <option value="motion"> موشن گرافیک </option>
                            <option value="other"> سایر...  </option>
                        </select>
                    </div>
                    <div id="testForm" class="form-group" style="display: none;">
                        <label for="project-type">نوع پروژه:</label>
                        <select id="project-type" name="project-type" required>
                            <option value="">انتخاب نشده</option>
                            <option value="poster">تست</option>
                            <option value="banner"> نفوذ</option>
                            <option value="social"> امنیت </option>
                            <option value="other"> سایر...  </option>
                        </select>
                    </div>
 </div>
                <script>
                    let webCat = document.getElementById('webCat');
let graphCat = document.getElementById('graphCat');
let webForm = document.getElementById('webForm');
let graphForm = document.getElementById('graphForm');
let testCat = document.getElementById('testCat');
let testForm = document.getElementById('testForm');
let categ = 'web';

webCat.addEventListener('click', () => {
    activeBox(webCat);
    graphCat.classList.remove('activeBox');
    testCat.classList.remove('activeBox');
    categ = 'web'; 
    updateFormDisplay(); 
});

graphCat.addEventListener('click', () => {
    activeBox(graphCat);
    webCat.classList.remove('activeBox');
    testCat.classList.remove('activeBox');
    categ = 'graph'; 
    updateFormDisplay();
});
testCat.addEventListener('click', () => {
    activeBox(testCat);
    webCat.classList.remove('activeBox');
    graphCat.classList.remove('activeBox');
    categ = 'test'; 
    updateFormDisplay();
});

function activeBox(e) {
    e.classList.add('activeBox');
}

function updateFormDisplay() {
    if (categ === 'web') { 
        webForm.style.display = 'block'; 
        graphForm.style.display = 'none'; 
        testForm.style.display = 'none'; 
    } else if(categ ==='graph'){
        webForm.style.display = 'none'; 
        testForm.style.display = 'none'; 
        graphForm.style.display = 'block'; 
    }
    else if(categ === 'test'){
         webForm.style.display = 'none'; 
        testForm.style.display = 'block'; 
        graphForm.style.display = 'none'; 
    }
}


updateFormDisplay();

                </script>
                    <div class="form-group formButtons">
                        <button type="button" id="back1">بازگشت</button>
                        <button type="button" id="next2">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" style="display: none;"> 
                 <div class="steps-wrapper">   
                    <div class="form-group">
                        <label for="details">جزئیات پروژه:</label>
                        <textarea id="details" name="details" required></textarea>
                    </div>
                   </div>
                    <div class="form-group formButtons">
                        <button type="button" id="back2">بازگشت</button>
                        <button type="button" id="next3">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step-4" style="display: none;">
                   <div class="steps-wrapper">

                    <div class="form-group">
                        <label for="budget">بودجه تقریبی:</label>
                        <input type="number" id="budget" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">تاریخ تحویل:</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>
                   </div>

                    <div class="form-group formButtons">
                        <button type="button" id="back3">بازگشت</button>
                        <button type="submit">ارسال سفارش</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 طراحی شده توسط شما | <a href="#">شرایط و ضوابط</a></p>
    </footer>

    <script>
      
        // Navigation between steps
        document.getElementById('next1').addEventListener('click', function() {
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('step1').classList.remove('active-step');
            document.getElementById('step2').classList.add('active-step');
            document.getElementById('lampOff1').style.display ='block';
            document.getElementById('lampOn1').style.display ='none';
            document.getElementById('lampOn2').style.display ='block';

        });

        document.getElementById('back1').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step1').classList.add('active-step');
            document.getElementById('lampOn2').style.display ='none';
            document.getElementById('lampOn1').style.display ='block';
          
        });

        document.getElementById('next2').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
            document.getElementById('lampOff2').style.display ='block';
            document.getElementById('lampOn2').style.display ='none';
            document.getElementById('lampOn3').style.display ='block';
        });

        document.getElementById('back2').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step2').classList.add('active-step');
            document.getElementById('lampOn3').style.display ='none';
            document.getElementById('lampOn2').style.display ='block';
        });

        document.getElementById('next3').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-4').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step4').classList.add('active-step');
            document.getElementById('lampOff3').style.display ='block';
            document.getElementById('lampOn3').style.display ='none';
            document.getElementById('lampOn4').style.display ='block';
        });

        document.getElementById('back3').addEventListener('click', function() {
            document.getElementById('step-4').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step4').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
            document.getElementById('lampOn4').style.display ='none';
            document.getElementById('lampOn3').style.display ='block';
        });
    </script>

</body>
</html>