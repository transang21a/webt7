<?php

@include 'config.php';

session_start();

$user_id = '';

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if (!empty($name)) {
      // $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      // $update_name->execute([$name, $user_id]);

      mysqli_query($conn, "UPDATE `users` SET name = '$name' WHERE id = '$user_id'") or die('Lỗi truy vấn');
   }

   // if(!empty($email)){
   //    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   //    $select_email->execute([$email]);
   
   //    $check_email = mysqli_query($conn, "UPDATE `users` SET email = '$email' WHERE id = '$user_id'") or die('Lỗi truy vấn');
   //    if($select_email->rowCount() > 0) {
   //       $message[] = 'Email đã được sử dụng!';
   //    }else{

   mysqli_query($conn, "UPDATE `users` SET email = '$email' WHERE id = '$user_id'") or die('Lỗi truy vấn');

   // $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
   // $update_email->execute([$email, $user_id]);
   //    }
   //  }


   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   // $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   // $select_prev_pass->execute([$user_id]);

   $fetch_prev =  mysqli_query($conn, "SELECT password FROM `users` WHERE id = '$user_id'") or die('Lỗi truy vấn');
   $fetch_prev_pass = mysqli_fetch_assoc($fetch_prev);
   // $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = $_POST['confirm_pass'];
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if ($old_pass != $prev_pass) {
      $message[] = 'Mật khẩu cũ không khớp!';
   }
   if ($new_pass != $confirm_pass) {
      $message[] = 'Mật khẩu xác nhận không khớp!';
   } else {
      mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('Lỗi truy vấn');
      // $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
      // $update_pass->execute([$confirm_pass, $user_id]);
      $message[] = 'Cập nhật mật khẩu thành công!';
   }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cập nhật hồ sơ</title>

   <!-- Liên kết font awesome cdn  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Liên kết tệp CSS tùy chỉnh  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- Phần header bắt đầu  -->
   <?php include 'header.php'; ?>
   <!-- Phần header kết thúc -->

   <section class="form-container update-form">

      <form action="" method="post">
         <h3>Cập nhật hồ sơ</h3>
         <input type="text" name="name" placeholder="<?= $_SESSION['user_name']  ?>" class="box" maxlength="50">
         <input type="email" name="email" placeholder="<?= $_SESSION['user_email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="old_pass" placeholder="Nhập mật khẩu cũ" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu mới" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="Cập nhật ngay" name="submit" class="btn">
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- Liên kết tệp JS tùy chỉnh  -->
   <script src="js/script.js"></script>

</body>

</html>
