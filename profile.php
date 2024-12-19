<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="vi">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hồ sơ người dùng</title>

   <!-- Liên kết font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Liên kết tệp CSS tùy chỉnh -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- phần header bắt đầu  -->
   <?php include 'header.php'; ?>
   <!-- phần header kết thúc -->

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
         $image = '';
         if ($_SESSION['user_sex'] == 'male'){
            $image = 'images/male.png';
         }
         else if ($_SESSION['user_sex']=='female'){
            $image = 'images/female.png';
         }
         else {
            $image = 'uploaded_img/user-icon.png';
         }
         ?>
         <img src="<?php echo $image; ?>" alt="">
         <p><i class="fa-solid fa-house"></i><span>ID: <?= $_SESSION['user_id']; ?></span></p>
         <p><i class="fas fa-user"></i><span><span>Tên: <?= $_SESSION['user_name']; ?></span></span></p>
         <p><i class="fa-regular fa-envelope"></i><span>Email: <?= $_SESSION['user_email']; ?></span></p>
         <p><i class="fa-regular fa-envelope"></i><span>Giới tính: <?= $_SESSION['user_sex']; ?></span></p>

         <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
         <a href="update_address.php" class="btn">Cập nhật địa chỉ</a>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- Liên kết tệp JS tùy chỉnh -->
   <script src="js/script.js"></script>

</body>

</html>
