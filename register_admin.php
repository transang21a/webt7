<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, sha1($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, sha1($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Truy vấn thất bại');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Người dùng đã tồn tại!';
   }else{
      if($pass != $cpass){
         $message[] = 'Mật khẩu xác nhận không khớp!';
      }else{
        $ad = 'admin';
        $type_ad = filter_var($ad, FILTER_SANITIZE_STRING);
        $type = mysqli_real_escape_string($conn,  $type_ad);
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$type')") or die('Truy vấn thất bại');
         $message[] = 'Đăng ký thành công!';
         header('location:login_admin.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>

   <!-- Liên kết font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Liên kết tệp CSS tùy chỉnh -->
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
      <h3>Đăng ký quản trị viên ngay</h3>
      <input type="text" name="name" class="box" placeholder="Nhập tên người dùng" required>
      <input type="email" name="email" class="box" placeholder="Nhập email của bạn" required>
      <input type="password" name="pass" class="box" placeholder="Nhập mật khẩu" required>
      <input type="password" name="cpass" class="box" placeholder="Xác nhận mật khẩu" required>
      <input type="submit" class="btn" name="submit" value="Đăng ký ngay">
      <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
   </form>

</section>

</body>
</html>
