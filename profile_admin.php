<?php

include 'config.php';

session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hồ sơ quản trị viên</title>

   <!-- Liên kết font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Liên kết tệp CSS tùy chỉnh cho admin -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<?php @include 'admin_header.php'; ?>
<body>
   
<!-- header section starts  -->

<!-- header section ends -->

<section class="user-details">

<?php 

   // $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   // $select_profile->execute([$user_id]);
  
   //    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);


   // $select_products1 = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Truy vấn thất bại');
   // if(mysqli_num_rows($select_products1) > 0)
   //    while($fetch = mysqli_fetch_assoc($select_products1))
   //    echo $user_id;

?>
   <div class="user">
      <?php
         
      ?>
      <img src="uploaded_img/user-icon.png" alt="">
      <p><i class="fa-solid fa-house"></i><span><?= $_SESSION['admin_id']; ?></span></p>
      <p><i class="fas fa-user"></i><span><span><?= $_SESSION['admin_name']; ?></span></span></p>
      <p><i class="fa-regular fa-envelope"></i><span><?= $_SESSION['admin_email']; ?></span></p>
      
      <a href="admin_update_profile.php" class="btn">Cập nhật thông tin</a>
      <!-- <a href="update_address.php" class="btn">Cập nhật địa chỉ</a> -->
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Liên kết tệp JS tùy chỉnh -->
<script src="js/script.js"></script>

</body>
</html>
