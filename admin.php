<?php
// اتصال به دیتابیس
include 'database/db.php'; // مسیر فایل db.php

// ایجاد اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// دریافت اطلاعات از دیتابیس
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// بررسی اینکه آیا داده‌ای وجود دارد
if ($result->num_rows > 0) {
    // شروع جدول
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>نوع پروژه</th>
                <th>جزئیات</th>
                <th>بودجه</th>
                <th>مهلت</th>
            </tr>";
    
    // نمایش داده‌ها
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["project_type"] . "</td>
                <td>" . $row["details"] . "</td>
                <td>" . $row["budget"] . "</td>
                <td>" . $row["deadline"] . "</td>
              </tr>";
    }
    // پایان جدول
    echo "</table>";
} else {
    echo "هیچ سفارشی وجود ندارد.";
}

// بستن اتصال به دیتابیس
$conn->close();
?>
