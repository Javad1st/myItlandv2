<?php include '../jdf.php';


include '../database/db.php';

$number=1;


$date=jdate('Y/m/d');


$select=$conn->prepare("SELECT * FROM users");

$select->execute();

$users=$select->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین-مشاهده مقاله </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
     
       body{
        text-align: center;
       }
    </style>
</head>
<body dir="rtl" >
    <div class="container">
   
    <?php  include 'header.php' ?>

    <h1>بخش مشاهده کاربران   </h1>
    <?php  echo $date ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">id</th>
      <th scope="col">اسم</th>
      <th scope="col"> ایمبل</th>
      <th scope="col">عملیات </th>
    </tr>
  </thead>
  <?php foreach ($users as $user):?>
  <tbody>
    <tr>
      <th scope="row"> <?= $number ++; ?> </th>
      <td><?= $user['id'] ?> </td>
      <td><?= $user['name'] ?> </td>
      <td><?= $user['email'] ?></td>
      <td><a href="delusers.php?id=<?= $user['id']; ?>"  class="btn btn-danger" >حذف</a> </td>

    </tr>
   
  </tbody>
  <?php endforeach;?>
</table>
       
     
         
    </div>
</body>
<script src="menu.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>