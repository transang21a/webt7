<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Về chúng tôi </h3>
    <p> <a href="home.php">Trang chủ </a> / Về </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>Tại sao nên chọn chúng tôi?</h3>
            <p>Chúng tôi cam kết mang đến sự hài lòng qua từng sản phẩm, 
                với hoa tươi chất lượng cao, được thiết kế độc đáo và giao hàng đúng hẹn. 
                Đội ngũ tận tâm luôn sẵn sàng phục vụ và đáp ứng mọi nhu cầu của bạn. 
                Chọn chúng tôi, bạn không chỉ nhận được sản phẩm mà còn cảm nhận trọn vẹn giá trị yêu thương trong từng bông hoa.</p>
                <p>Dịch vụ uy tín, giá cả hợp lý, vì chúng tôi hiểu rằng niềm vui của bạn là mục tiêu lớn nhất của chúng tôi.</p>
            <a href="shop.php" class="btn">Đặt mua ngay </a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Chúng tôi cung cấp những gì?</h3>
            <p>"Chúng tôi cung cấp hoa tươi chất lượng, thiết kế độc đáo và dịch vụ giao hàng nhanh chóng,
                 mang đến những món quà ý nghĩa cho mọi dịp đặc biệt trong cuộc sống." 🌸</p>
            <a href="contact.php" class="btn">Liên hệ với chúng tôi </a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>Chúng tôi là ai?</h3>
            <p>"Chúng tôi là cửa hàng hoa tươi chuyên cung cấp những sản phẩm hoa đẹp,
                 chất lượng, được tuyển chọn kỹ lưỡng. Với đội ngũ tận tâm và dịch vụ chuyên nghiệp,
                  chúng tôi luôn nỗ lực mang đến cho bạn những món quà hoa đầy ý nghĩa,
                   giúp bạn gửi gắm yêu thương và cảm xúc đến những người thân yêu trong mọi dịp đặc biệt." 🌷</p>
            <a href="#reviews" class="btn">Đánh giá của khách hàng </a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Đánh giá của khách hàng</h1>

    <div class="box-container">

    <?php 
          $select_contact = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
          if(mysqli_num_rows($select_contact) > 0){
             while($fetch_contact = mysqli_fetch_assoc($select_contact)){
       ?>
          
          <div class="box">
            <img src="uploaded_img/user-icon.png" alt="">
            <p> <?php echo $fetch_contact['message']; ?></p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3><?php echo $fetch_contact['name']; ?></h3>
        </div>

       <?php
          }
        }
       ?>
       
        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>“Tôi rất hài lòng với dịch vụ của cửa hàng hoa này. Hoa luôn tươi mới và được giao đúng giờ.
                 Tôi đã mua hoa tặng sinh nhật bạn gái và cô ấy rất bất ngờ và vui mừng.
                 Cảm ơn cửa hàng đã mang lại một món quà tuyệt vời như vậy!”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Tiến Bịp </h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>“Lần đầu tiên tôi mua hoa ở đây và thật sự rất ấn tượng. Bó hoa tôi nhận được rất đẹp và được đóng gói cẩn thận.
                 Dịch vụ giao hàng nhanh chóng, nhân viên cũng rất nhiệt tình. Sẽ tiếp tục ủng hộ cửa hàng này!”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Messi </h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p> “Mua hoa cho buổi lễ khai trương của công ty, và tôi rất hài lòng với lựa chọn của mình. Hoa tươi, đẹp, thiết kế rất chuyên nghiệp.
                 Cảm ơn cửa hàng đã giúp ngày khai trương của chúng tôi trở nên ấn tượng hơn.”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ronaldo </h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p> “Cửa hàng hoa này thực sự rất tuyệt vời! Tôi đã mua hoa tặng mẹ vào dịp lễ và cô ấy rất thích. Hoa rất tươi, hương thơm dễ chịu.
                 Mình sẽ giới thiệu cửa hàng này cho bạn bè và người thân.”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>G-Dragon </h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>“Dịch vụ giao hoa của cửa hàng này rất chuyên nghiệp. Lần trước tôi mua hoa cho dịp sinh nhật của bạn và hoa đã đến nơi rất nhanh chóng. 
                Tôi thích cách đóng gói và chăm sóc khách hàng tại đây. Sẽ quay lại!”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Donal Trump </h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>“Hoa của cửa hàng luôn đẹp và tươi lâu. Tôi thường xuyên đặt hoa cho các dịp đặc biệt và luôn cảm thấy hài lòng.
                 Cảm ơn đội ngũ cửa hàng vì đã cung cấp những sản phẩm chất lượng và dịch vụ tuyệt vời.”</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Kim Chong Un </h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>