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

        header {
            background-color:rgb(25, 25, 25);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solidrgb(255, 255, 255);
        }

        h1 {
            font-size: 36px;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            /* gap: 1rem; */
        }

        /* .form-container:hover {
            transform: translateY(-5px);
        } */

        .step-container {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            gap: 0px;
            position: relative;
            margin-left: 1rem;
        }
      
        .step:first-child{
            border-radius: 0 20px 20px 0;
        }
        .step:last-child{
            border-radius: 20px 0px 0px 20px;
        }

        .lamp{
            position: absolute;
            right: 40%;
          top: -43px;
          z-index: 1;
        }
        @media screen and (max-width:770px) {
            .step:first-child{
            border-radius: 20px 20px 0px 0px;
        }
        .step:last-child{
            border-radius: 0px 0px 20px 20px;
        }
        .form-container{
            flex-direction: row;
        }
        .form-group button{
            font-size: 12px!important;
        }
        
        .lamp{
            position: absolute;
            right: -43px;
          top: 4px;
          rotate: 90deg;
         
        }
    
        }
        .step {
            z-index: 1;
            position: relative;
            width: 25%;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            background-color:#2a2a2a;
            color: white;
            /* border-radius: 5px; */
            min-width: 50px;
            transition: background-color 0.3s ease;
        }
       
        .active-step {
            background-color: #3cd972;
            color: white;
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

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #3cd972;
            outline: none;
        }

        .form-group button {
            background-color:rgb(0, 0, 0);
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 0.4rem;
            transition: background-color 0.3s ease;
            
        }

        .form-group button:hover {
            background-color: #3cd972;
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
            .boxes{
                flex-direction: column;
            }
            #graphCat{
                margin-top: -2rem;
            }
        }
        .boxes{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.3rem;
           
        }
        .catBox{
            padding: 0.2rem 0.8rem;
            text-align: center;
            background-color: #333;
            border-radius: 12px;
            transition: all ease-out 200ms;
            font-size: x-large;
            color: #f5f5f5;
            margin-bottom: 2rem;
            cursor: pointer;
        }
        .catBox:hover{
           
            transform: translateY(-1px);
        }
        .activeBox
        {
            background-color:#3cd972;
            transform: translateY(-1px);

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
            
            <!-- Step indicators -->
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

            <form method="POST">
                <!-- Step 1 -->
                <div id="step-1">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <button type="button" id="next1">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" style="display: none;">

                    <div class="boxes">
                        <div id="webCat" class="catBox activeBox">وبسایت</div>
                        <div id="graphCat" class="catBox">گرافیک</div>
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
                <script>
                    let webCat = document.getElementById('webCat');
let graphCat = document.getElementById('graphCat');
let webForm = document.getElementById('webForm');
let graphForm = document.getElementById('graphForm');
let categ = 'web';

webCat.addEventListener('click', () => {
    activeBox(webCat);
    graphCat.classList.remove('activeBox');
    categ = 'web'; 
    updateFormDisplay(); 
});

graphCat.addEventListener('click', () => {
    activeBox(graphCat);
    webCat.classList.remove('activeBox');
    categ = 'graph'; 
    updateFormDisplay();
});

function activeBox(e) {
    e.classList.add('activeBox');
}

function updateFormDisplay() {
    if (categ === 'web') { 
        webForm.style.display = 'block'; 
        graphForm.style.display = 'none'; 
    } else {
        webForm.style.display = 'none'; 
        graphForm.style.display = 'block'; 
    }
}


updateFormDisplay();

                </script>
                    <div class="form-group">
                        <button type="button" id="back1">بازگشت</button>
                        <button type="button" id="next2">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" style="display: none;">
                    <div class="form-group">
                        <label for="details">جزئیات پروژه:</label>
                        <textarea id="details" name="details" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="back2">بازگشت</button>
                        <button type="button" id="next3">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step-4" style="display: none;">
                    <div class="form-group">
                        <label for="budget">بودجه تقریبی:</label>
                        <input type="number" id="budget" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">تاریخ تحویل:</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>
                    <div class="form-group">
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
<?php
// اتصال به دیتابیس
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_orders";

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #3cd972;
        }

        h1 {
            font-size: 36px;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .step-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            width: 25%;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            background-color: #ccc;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .active-step {
            background-color: #3cd972;
            color: white;
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

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #3cd972;
            outline: none;
        }

        .form-group button {
            background-color: #3cd972;
            color: white;
            padding: 15px 25px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #3cd972;
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
        }

    </style>
</head>
<body>

    <header>
        <h1>سفارش پروژه طراحی سایت</h1>
    </header>

    <div class="container">
        <div class="form-container">
            <?php if (isset($message)): ?>
                <p style="color: green; font-size: 18px; text-align: center;"><?php echo $message; ?></p>
            <?php endif; ?>
            
            <!-- Step indicators -->
            <div class="step-container">
                <div class="step active-step" id="step1">مرحله 1
                    <img  class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                    <img class="lamp lampOff"  src="tasavir/lampOn.png" alt="" width="50px">
                </div>
                <div class="step" id="step2">مرحله 2
                <img  class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img class="lamp lampOff"  src="tasavir/lampOn.png" alt="" width="50px">
                </div>
                <div class="step" id="step3">مرحله 3
                <img  class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img class="lamp lampOff"  src="tasavir/lampOn.png" alt="" width="50px">
                </div>
                <div class="step" id="step4">مرحله 4
                <img  class="lamp lampOff" src="tasavir/lampOff.png" alt="" width="50px">
                <img class="lamp lampOff"  src="tasavir/lampOn.png" alt="" width="50px">
                </div>
            </div>

            <form method="POST">
                <!-- Step 1 -->
                <div id="step-1">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <button type="button" id="next1">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" style="display: none;">
                    <div class="form-group">
                        <label for="project-type">نوع پروژه:</label>
                        <select id="project-type" name="project-type" required>
                            <option value="">انتخاب کنید</option>
                            <option value="website">وبسایت</option>
                            <option value="ecommerce">فروشگاه اینترنتی</option>
                            <option value="portfolio">پورتفولیو</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="back1">بازگشت</button>
                        <button type="button" id="next2">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" style="display: none;">
                    <div class="form-group">
                        <label for="details">جزئیات پروژه:</label>
                        <textarea id="details" name="details" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="back2">بازگشت</button>
                        <button type="button" id="next3">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step-4" style="display: none;">
                    <div class="form-group">
                        <label for="budget">بودجه تقریبی:</label>
                        <input type="number" id="budget" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">تاریخ تحویل:</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>
                    <div class="form-group">
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
        });

        document.getElementById('back1').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step1').classList.add('active-step');
        });

        document.getElementById('next2').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
        });

        document.getElementById('back2').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step2').classList.add('active-step');
        });

        document.getElementById('next3').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-4').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step4').classList.add('active-step');
        });

        document.getElementById('back3').addEventListener('click', function() {
            document.getElementById('step-4').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step4').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
        });
    </script>

</body>
</html>
<?php
// اتصال به دیتابیس
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_orders";

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #3cd972;
        }

        h1 {
            font-size: 36px;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .step-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            width: 25%;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            background-color: #ccc;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .active-step {
            background-color: #3cd972;
            color: white;
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

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #3cd972;
            outline: none;
        }

        .form-group button {
            background-color: #3cd972;
            color: white;
            padding: 15px 25px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #3cd972;
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
        }

    </style>
</head>
<body>

    <header>
        <h1>سفارش پروژه طراحی سایت</h1>
    </header>

    <div class="container">
        <div class="form-container">
            <?php if (isset($message)): ?>
                <p style="color: green; font-size: 18px; text-align: center;"><?php echo $message; ?></p>
            <?php endif; ?>
            
            <!-- Step indicators -->
            <div class="step-container">
                <div class="step active-step" id="step1">مرحله 1</div>
                <div class="step" id="step2">مرحله 2</div>
                <div class="step" id="step3">مرحله 3</div>
                <div class="step" id="step4">مرحله 4</div>
            </div>

            <form method="POST">
                <!-- Step 1 -->
                <div id="step-1">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <button type="button" id="next1">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" style="display: none;">
                    <div class="form-group">
                        <label for="project-type">نوع پروژه:</label>
                        <select id="project-type" name="project-type" required>
                            <option value="">انتخاب کنید</option>
                            <option value="website">وبسایت</option>
                            <option value="ecommerce">فروشگاه اینترنتی</option>
                            <option value="portfolio">پورتفولیو</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="back1">بازگشت</button>
                        <button type="button" id="next2">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" style="display: none;">
                    <div class="form-group">
                        <label for="details">جزئیات پروژه:</label>
                        <textarea id="details" name="details" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="back2">بازگشت</button>
                        <button type="button" id="next3">مرحله بعد</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step-4" style="display: none;">
                    <div class="form-group">
                        <label for="budget">بودجه تقریبی:</label>
                        <input type="number" id="budget" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">تاریخ تحویل:</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>
                    <div class="form-group">
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
        });

        document.getElementById('back1').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step1').classList.add('active-step');
        });

        document.getElementById('next2').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
        });

        document.getElementById('back2').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step2').classList.add('active-step');
        });

        document.getElementById('next3').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-4').style.display = 'block';
            document.getElementById('step3').classList.remove('active-step');
            document.getElementById('step4').classList.add('active-step');
        });

        document.getElementById('back3').addEventListener('click', function() {
            document.getElementById('step-4').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
            document.getElementById('step4').classList.remove('active-step');
            document.getElementById('step3').classList.add('active-step');
        });
    </script>

</body>
</html>
