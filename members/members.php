<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>صفحه اعضای سایت</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

    @font-face {
  font-family: yekan;
  font-style: normal;
  font-weight: bolder;
  src: url(../yekan/Yekan-Bakh-FaNum-07-Heavy.woff);
}

@font-face {
  font-family: yekan;
  font-style: normal;
  font-weight: bold;
  src: url(../yekan/Yekan-Bakh-FaNum-06-Bold.woff);
}

@font-face {
  font-family: yekan;
  font-style: normal;
  font-weight: 900;
  src: url(../yekan/Yekan-Bakh-FaNum-08-Fat.woff);
}

@font-face {
  font-family: yekan;
  font-style: normal;
  font-weight: 700;
  src: url(../yekan/Yekan-Bakh-FaNum-05-Medium.woff);
}



@font-face {
  font-family: yekan;
  font-style: normal;
  font-weight: 300;
  src: url(../yekan/Yekan-Bakh-FaNum-04-Regular.woff);
}

    /* ریست و تنظیمات پایه */
    * {
      font-family: yekan;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color:rgba(238, 239, 238, 0.64);
      color: #333;
    }
    .container {
      max-width: 1300px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }
    h2 {
      font-size: 2.5rem;
      color: #000;
      margin-bottom: 20px;
      position: relative;
    }
    h2::after {
      content: "";
      display: block;
      width: 80px;
      height: 4px;
      background-color:rgb(20, 210, 102); 
      margin: 10px auto 0;
      border-radius: 2px;
    }
    
    
    .members {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    
   
    .member-box {
      width: 400px;
      height: 150px;
      display: flex;
      border: 1px solid #ddd;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.28),rgb(223, 255, 241));
    }
    .member-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    /* سمت چپ باکس برای اطلاعات عضو */
    .member-info {
      width: 60%;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: right;
    }
    .member-info h3 {
      font-size: 1.5rem;
      font-weight: 900;
      margin-bottom: 8px;
      color: #000;
    }
    .member-info p {
      font-size: 0.95rem;
      color: #555;
    }
    
    /* سمت راست باکس برای تصویر عضو */
    .member-image {
      width: 40%;
    }
    .member-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    /* در صورتی که صفحه بسیار کوچک باشد (کمتر از 400px) */
    @media (max-width: 400px) {
      .member-box {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>اعضای تیم ما</h2>
    <div class="members">
      <!-- عضو اول -->
      <div class="member-box">
        <div class="member-info">
          <h3>نام عضو اول</h3>
          <p>مهارت‌ها: توسعه وب، طراحی رابط کاربری و UX</p>
        </div>
        <div class="member-image">
          <img src="../tasavir/lampOn.png" alt="عضو اول">
        </div>
      </div>
      <!-- عضو دوم -->
      <div class="member-box">
        <div class="member-info">
          <h3>نام عضو دوم</h3>
          <p>مهارت‌ها: برنامه‌نویسی، مدیریت پروژه و توسعه اپلیکیشن</p>
        </div>
        <div class="member-image">
          <img src="../tasavir/lampOn.png" alt="عضو دوم">
        </div>
      </div>
      <!-- عضو سوم -->
      <div class="member-box">
        <div class="member-info">
          <h3>نام عضو سوم</h3>
          <p>مهارت‌ها: بازاریابی دیجیتال، سئو و محتوا</p>
        </div>
        <div class="member-image">
          <img src="../tasavir/lampOn.png" alt="عضو سوم">
        </div>
      </div>
    </div>
  </div>
</body>
</html>