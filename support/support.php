<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>صفحه پشتیبانی و مشاوره</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap"
    rel="stylesheet"
  >
  <style>
    @font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bolder;
  src: url(../yekan/Yekan-Bakh-FaNum-07-Heavy.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: bold;
  src: url(../yekan/Yekan-Bakh-FaNum-06-Bold.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 900;
  src: url(../yekan/Yekan-Bakh-FaNum-08-Fat.woff);
}

@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 700;
  src: url(../yekan/Yekan-Bakh-FaNum-05-Medium.woff);
}



@font-face {
  font-family: iranSans;
  font-style: normal;
  font-weight: 300;
  src: url(../yekan/Yekan-Bakh-FaNum-04-Regular.woff);
}

    /* ریست اولیه */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: iranSans;
    }

    body {
      
      background: #f0f2f5;
      color: #333;
      line-height: 1.6;
      padding: 20px;
    }

    /* کانتینر کلی */
    .support-page {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      overflow: hidden;
    }

    /* هدر با تصویر */
    .support-page header img {
      display: block;
      width: 100%;
      height: auto;
    }

    /* محتوای توضیحات */
    .support-page main {
      padding: 24px;
    }

    .support-page main h1 {
      font-size: 1.8rem;
      margin-bottom: 16px;
      color: #04cc72;
      font-weight: 500;
    }

    .support-page main p {
      margin-bottom: 12px;
    }

    /* فوتر با دکمه‌ها */
    .support-page footer {
      padding: 20px;
      background: #fafafa;
      border-top: 1px solid #e0e0e0;
    }

    .support-page .buttons {
      display: flex;
      gap: 12px;
    }

    .support-page .buttons button {
      flex: 1;
      padding: 14px 0;
      background: #2b2b2b;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .support-page .buttons button:hover {
      background: #17f98f;
    }
    .flex-svg{
        display: flex;
        gap: 2px;
        justify-content: center;
        align-items: center;
    }
  </style>
</head>
<body>

  <div class="support-page">

    <!-- هدر با تصویر -->
    <header>
      <img src="../tasavir/supportPic.jpg" alt="پشتیبانی و مشاوره" style="width: 100%; height: 300px;">
    </header>

    <!-- متن توضیحات -->
    <main>
      <h1>پشتیبانی و مشاوره آنلاین</h1>
      <p>
        در این بخش می‌توانید سوالات فنی خود را مطرح کنید و از متخصصین ما راهنمایی بگیرید.
      </p>
      <p>
        اگر نیاز به راهنمایی در پیاده‌سازی قالب، بهینه‌سازی سرعت یا هر موضوع دیگری دارید،
        تیم پشتیبانی ما آماده پاسخگویی سریع است.
      </p>
      <p>
        برای سهولت کار، از دکمه‌های زیر استفاده کنید تا بلافاصله چت زنده را آغاز یا تیکت پشتیبانی ارسال کنید.
      </p>
    </main>

    <!-- دکمه‌های چت و تیکت -->
    <footer>
      <div class="buttons">
        
        <button class="flex-svg">شروع چت آنلاین
            <svg width="24px" height="24px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17 3.33782C15.5291 2.48697 13.8214 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22C17.5228 22 22 17.5228 22 12C22 10.1786 21.513 8.47087 20.6622 7" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 12H8.009M11.991 12H12M15.991 12H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

        </button>
        
      
        <button onclick="toggleModal()"  class="flex-svg">ارسال تیکت پشتیبانی

            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0137 17L14.0079 19.0029C14.0065 19.4731 14.0058 19.7081 13.8591 19.8541C13.7124 20 13.4767 20 13.0054 20H9.99502C6.21438 20 4.32407 20 3.14958 18.8284C2.34091 18.0218 2.08903 16.8766 2.01058 15.0105C1.99502 14.6405 1.98724 14.4554 2.05634 14.332C2.12545 14.2085 2.40133 14.0545 2.95308 13.7463C3.56586 13.4041 3.98007 12.7503 3.98007 12C3.98007 11.2497 3.56586 10.5959 2.95308 10.2537C2.40133 9.94554 2.12545 9.79147 2.05634 9.66802C1.98724 9.54458 1.99502 9.35954 2.01058 8.98947C2.08903 7.12339 2.34091 5.97823 3.14958 5.17157C4.32407 4 6.21439 4 9.99502 4H13.5052C13.7814 4 14.0056 4.22298 14.0064 4.49855L14.0137 7C14.0137 7.55228 14.4625 8 15.0162 8L15.0162 10C14.4625 10 14.0137 10.4477 14.0137 11V13C14.0137 13.5523 14.4625 14 15.0162 14V16C14.4625 16 14.0137 16.4477 14.0137 17Z" fill="#f7f7f7"></path> <path opacity="0.5" d="M15.0166 15.9998C15.5703 15.9998 16.0191 16.4475 16.0191 16.9998V18.9763C16.0191 19.4578 16.0191 19.6986 16.1735 19.8462C16.3279 19.9939 16.5641 19.9839 17.0366 19.9639C18.8995 19.885 20.0441 19.633 20.8508 18.8282C21.6595 18.0216 21.9114 16.8764 21.9898 15.0104C22.0054 14.6403 22.0132 14.4552 21.9441 14.3318C21.875 14.2083 21.5991 14.0543 21.0473 13.7462C20.4346 13.404 20.0203 12.7501 20.0203 11.9998C20.0203 11.2495 20.4346 10.5957 21.0473 10.2535C21.5991 9.94536 21.875 9.7913 21.9441 9.66785C22.0132 9.5444 22.0054 9.35936 21.9898 8.98929C21.9114 7.12321 21.6595 5.97805 20.8508 5.17139C19.9731 4.29586 18.6956 4.07463 16.5282 4.01872C16.2486 4.01151 16.0191 4.237 16.0191 4.516V6.99982C16.0191 7.55211 15.5703 7.99982 15.0166 7.99982L15.0166 9.99982C15.5703 9.99982 16.0191 10.4475 16.0191 10.9998V12.9998C16.0191 13.5521 15.5703 13.9998 15.0166 13.9998V15.9998Z" fill="#f7f7f7"></path> </g></svg>
        </button>
       
      </div>
    </footer>

  </div>
<!-- مودال -->
<div id="contactModal" class="modal-overlay">
  <div class="modal-content">
   <b> <h2>ارسال تیکت پشتیبانی</h2></b>
    
    <!-- پیغام موفقیت -->
    <div id="message-response"></div>

    <p class="modal-desc">برای <strong>ارسال تیکت</strong>، لطفاً شماره موبایل و پیام خود را وارد کنید:</p>
    <form id="contactForm" method="POST">
    <label for="name">نام و نام خانوادگی:</label>
      <input type="text" id="name" name="name" placeholder="" required>
      <label for="phone">شماره موبایل:</label>
      <input type="text" id="phone" name="phone" placeholder="مثلاً 09123456789" required>
   

      <label for="message">پیام:</label>
      <textarea name="message" rows="4" required></textarea>

      <div class="modal-actions">
        <button type="submit">ارسال</button>
        <button type="button" onclick="toggleModal()">بستن</button>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script>
  // ارسال فرم با AJAX
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // گرفتن داده‌های فرم
    const formData = new FormData(this);

    // ارسال درخواست AJAX
    fetch('contact.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      const messageResponse = document.getElementById('message-response');

      // نمایش پیام موفقیت یا خطا
      if (data.status === 'success') {
        messageResponse.innerHTML = `<p style="color: green; font-size: 16px; font-weight: bold;">${data.message}</p>`;
      } else {
        messageResponse.innerHTML = `<p style="color: red; font-size: 16px; font-weight: bold;">${data.message}</p>`;
      }

      // پاک کردن فرم پس از ارسال
      document.getElementById('contactForm').reset();
    })
    .catch(error => {
      console.error('خطا در ارسال داده‌ها:', error);
      document.getElementById('message-response').innerHTML = `<p style="color: red;">خطا در ارسال درخواست. لطفاً دوباره تلاش کنید.</p>`;
    });
  });

  // توگِل مودال
  function toggleModal() {
    document.getElementById('contactModal').classList.toggle('show');
  }
</script>

<!-- CSS -->
<style>
  .contact-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 50px;
    cursor: pointer;
    z-index: 1000;
    font-size: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    transition: background-color 0.2s;
  }

  .contact-btn:hover {
    background-color: #0056b3;
  }

  .modal-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 999;
  }

  .modal-overlay.show {
    display: flex;
  }

  .modal-content {
    background: #fff;
    padding: 22px 25px;
    border-radius: 10px;
    width: 90%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    font-family: sans-serif;
  }

  .modal-content h2 {
    margin-top: 0;
    font-size: 20px;
    margin-bottom: 8px;
    color: #333;
  }

  .modal-desc {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
  }

  .modal-content input,
  .modal-content textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: inherit;
  }

  .modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  .modal-actions button {
    padding: 8px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-family: inherit;
  }

  .modal-actions button[type="submit"] {
  background-color: #000000e8 !important;
    background-color: ;
    color: white;
  }

  .modal-actions button[type="button"] {
    background-color: #f1f1f1;
    color: #333;
     transition:all 200ms ease-in-out;
  }

  .modal-actions button:hover {
    color:white;
   
    opacity: 0.9; 
      background-color:red ;
  }
</style>

<!-- JS -->
<script>
  function toggleModal() {
    document.getElementById('contactModal').classList.toggle('show');
  }

  function validateForm() {
    const phone = document.getElementById('phone').value;
    const regex = /^09\d{9}$/;
    if (!regex.test(phone)) {
      alert('شماره موبایل باید ۱۱ رقمی و با 09 شروع شود.');
      return false;
    }
    return true;
  }
</script>
</div>
</body>
</html>