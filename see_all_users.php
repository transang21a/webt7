<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login_admin.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tài khoản người dùng</title>

   <!-- liên kết font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- liên kết tệp CSS tùy chỉnh -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'header.php' ?>

<!-- phần tài khoản người dùng bắt đầu -->

<section class="accounts">

   <h1 class="heading">Tài khoản người dùng</h1>

   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `users`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> ID người dùng: <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> Tên người dùng: <span><?= $fetch_accounts['name']; ?></span> </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có muốn xóa tài khoản này không?');">xóa</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Không có tài khoản nào</p>';
   }
   ?>

   </div>

</section>

<!-- phần tài khoản người dùng kết thúc -->

<!-- liên kết tệp JS tùy chỉnh -->
<script src="../js/admin_script.js"></script>

</body>
</html>
