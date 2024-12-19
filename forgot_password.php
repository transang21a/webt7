<?php

@include 'config.php';
session_start();


if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $type = 'user';
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
    // header('location:send_passwoid.php');
    $_SESSION['email'] = $email;
    header('location:send_password.php');
    // header('location:login.php');
}

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quên mật khẩu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>quên mật khẩu</h3>
      <!-- <input type="text" name="name" class="box" placeholder="nhập tên người dùng của bạn" required> -->
      <input type="email" name="email" class="box" placeholder="nhập email của bạn" required>
      <input type="submit" class="btn" name="submit" value="gửi ngay">
      <!-- <p>đã có tài khoản? <a href="login.php">đăng nhập ngay</a></p> -->
   </form>

</section>

</body>
</html>
