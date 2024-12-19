<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login_new.php');
}

if (isset($_POST['add_to_wishlist'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      $message[] = 'Đã được thêm vào danh sách yêu thích';
   } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Đã được thêm vào giỏ hàng';
   } else {
      mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      $message[] = 'Sản phẩm được thêm vào danh sách yêu thích';
   }
}

if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Đã được thêm vào giỏ hàng';
   } else {

      $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if (mysqli_num_rows($check_wishlist_numbers) > 0) {
         mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      }

      mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Sản phẩm đã được thêm vào giỏ hàng';
      mysqli_query($conn, "INSERT INTO `send_email`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
   }
}


//send message

if (isset($_POST['send'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if (mysqli_num_rows($select_message) > 0) {
      $message[] = 'Tin nhắn đã được gửi rồi!';
   } else {
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Tin nhắn đã được gửi thành công ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Nunito%3A200%2C300%2Cregular%2Citalic%2C600%2C700%2C800%2C900&amp;subset=vietnamese&amp;display=swap">

</head>

<body>

   <?php @include 'header.php'; ?>

   <!-- <section class="home"> -->

   <!-- <div class="content">
      <h3>new collections</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime reiciendis, modi placeat sit cumque molestiae.</p>
      <a href="about.php" class="btn">discover more</a>
   </div> -->
   <!-- <section id="slider">
      <div class="aspect-ratio-169">
         <img src="uploaded_img/beach florist.jpg">
         <img src="uploaded_img/bloomnation.jpg">
         <img src="uploaded_img/cottage rose.jpg">
         <img src="uploaded_img/fun bloomnation.jpg">
         <img src="uploaded_img/lavendor rose.jpg">
      </div>
      <div class="dot-container">
         <div class="dot active"></div>
         <div class="dot"></div>
         <div class="dot"></div>
         <div class="dot"></div>
         <div class="dot"></div>
      </div>
   </section> -->


   <section class="home" id="home">

      <div class="content">
         <h3>Cửa hàng hoa tươi </h3>
         <span> Hoa đẹp và tự nhiên </span>
         <p>Hoa tươi – món quà của thiên nhiên cho tình yêu và hạnh phúc.</p>
         <a href="#" class="btn">Đặt mua ngay </a>
      </div>

   </section>


   <!-- làm đẹp  -->

   <section class="about" id="about">

      <h1 class="heading"> <span> Về chúng tôi </span> </h1>

      <div class="row">

         <div class="video-container">
            <video src="images/about-vid.mp4" loop autoplay muted></video>
            <h3>Cửa hàng hoa tốt nhất </h3>
         </div>

         <div class="content">
            <h3>Tại sao nên chọn chúng tôi?</h3>
            <p>Chúng tôi cam kết mang đến sự hài lòng qua từng sản phẩm, với hoa tươi chất lượng cao, được thiết kế độc đáo và
                giao hàng đúng hẹn. Đội ngũ tận tâm luôn sẵn sàng phục vụ và đáp ứng mọi nhu cầu của bạn. 
                Chọn chúng tôi, bạn không chỉ nhận được sản phẩm mà còn cảm nhận trọn vẹn giá trị yêu thương trong từng bông hoa.</p>
            <p>Dịch vụ uy tín, giá cả hợp lý, vì chúng tôi hiểu rằng niềm vui của bạn là mục tiêu lớn nhất của chúng tôi.</p>
            <a href="#" class="btn">Xem thêm </a>
         </div>

      </div>

   </section>

   <section class="icons-container">

      <div class="icons">
         <img src="images/icon-1.png" alt="">
         <div class="info">
            <h3>Giao hàng miễn phí </h3>
            <span>Các đơn hàng phạm vi bán kính 5Km </span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-2.png" alt="">
         <div class="info">
            <h3>Nếu hoa bị hỏng </h3>
            <span>Đổi trả hoặc hoàn tiền </span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-3.png" alt="">
         <div class="info">
            <h3>Khuyến mãi và qùa tặng </h3>
            <span>Trên các đơn hàng </span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-4.png" alt="">
         <div class="info">
            <h3>Thanh toán an toàn </h3>
            <span>Thanh toán tiền mặt hoặc chuyển khoản </span>
         </div>
      </div>

   </section>



   <!-- </section> -->

   <section class="products">
      <h1 class="title">Mẫu giỏ hoa đẹp nổi bật </h1>
      <!-- <?php
            $page;
            if (!isset($_GET['page'])) {
               $page = 1;
               echo '<h1 class="title">Sản phẩm mới</h1>';
            } else if ($_GET['page'] == 2) {
               echo '<h1 class="title">Sản phẩm nổi bật</h1>';
            } else if ($_GET['page'] == 3) {
               echo '<h1 class="title">Hoa sinh nhật</h1>';
            } else if ($_GET['page'] == 4) {
               echo '<h1 class="title">Lãng hoa khai trương</h1>';
            } else {
               echo '<h1 class="title">Hoa tươi</h1>';
            }
            ?> -->
      <div class="box-container">

         <?php
         // if (isset($_GET['page'])) {
         //    $page = $_GET['page'];
         // } else {
         //    $page = 1;
         // }


         // $limit = 6; // 10 title per page
         // $start = ($page - 1) * $limit;

         // $total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
         // $total_page = $total_title / $limit;
         // $total_page = ceil($total_title / $limit);


         $query = "SELECT * FROM products LIMIT " . 1 . ", " . 6;
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($result)) {
         ?>
               <form action="" method="POST" class="box">
                  <a href="viewpage.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <input type="number" name="product_quantity" value="1" min="0" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Thêm vào danh sách yêu thích" name="add_to_wishlist" class="option-btn">
                  <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
         }



         ?>

         <?php
         $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $cart_num_rows = mysqli_num_rows($select_cart_count);
         ?>
      </div>
      <div class="icon-cart">
         <i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows ?></span>
      </div>

      <!-- <?php
            echo "<div class=\"pagination\">";
            echo '<a href="#">&laquo;</a> ';
            for ($i = 1; $i <= $total_page; $i++) {
               echo '<a href="home.php?page=' . $i . '">' . $i . '</a>  ';
            }
            echo '<a href="#">&raquo;</a> ';
            echo "</div>";
            ?> -->
      <div class="icon-sell">
         
         <img src="	https://tawk.link/5b319bc4d0b5a54796822b38/var/chat_bubble/e4315a3dbbdb0167fe6f0279a8868087dc08a162" alt="">
         <p>Hỗ trợ trực tuyến </p>

      </div>

   </section>
   <section class="products">
      <h1 class="title">Lãng hoa khai trương </h1>
      <!-- <?php
            $page;
            if (!isset($_GET['page'])) {
               $page = 1;
               echo '<h1 class="title">Sản phẩm mới</h1>';
            } else if ($_GET['page'] == 2) {
               echo '<h1 class="title">Sản phẩm nổi bật</h1>';
            } else if ($_GET['page'] == 3) {
               echo '<h1 class="title">Hoa sinh nhật</h1>';
            } else if ($_GET['page'] == 4) {
               echo '<h1 class="title">Lãng hoa khai trương</h1>';
            } else {
               echo '<h1 class="title">Hoa tươi</h1>';
            }
            ?> -->
      <div class="box-container">

         <?php
         // if (isset($_GET['page'])) {
         //    $page = $_GET['page'];
         // } else {
         //    $page = 1;
         // }


         // $limit = 6; // 10 title per page
         // $start = ($page - 1) * $limit;

         // $total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
         // $total_page = $total_title / $limit;
         // $total_page = ceil($total_title / $limit);


         $query = "SELECT * FROM products LIMIT " . 6 . ", " . 6;
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($result)) {
         ?>
               <form action="" method="POST" class="box">
                  <a href="viewpage.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <input type="number" name="product_quantity" value="1" min="0" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Thêm vào danh sách yêu thích" name="add_to_wishlist" class="option-btn">
                  <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
         }



         ?>

         <?php
         $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $cart_num_rows = mysqli_num_rows($select_cart_count);
         ?>
      </div>
      <div class="icon-cart">
         <i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows ?></span>
      </div>

      <!-- <?php
            echo "<div class=\"pagination\">";
            echo '<a href="#">&laquo;</a> ';
            for ($i = 1; $i <= $total_page; $i++) {
               echo '<a href="home.php?page=' . $i . '">' . $i . '</a>  ';
            }
            echo '<a href="#">&raquo;</a> ';
            echo "</div>";
            ?> -->

   </section>
   <section class="products">
      <h1 class="title">Mẫu hoa hot </h1>
      <!-- <?php
            $page;
            if (!isset($_GET['page'])) {
               $page = 1;
               echo '<h1 class="title">Sản phẩm mới</h1>';
            } else if ($_GET['page'] == 2) {
               echo '<h1 class="title">Sản phẩm nổi bật</h1>';
            } else if ($_GET['page'] == 3) {
               echo '<h1 class="title">Hoa sinh nhật</h1>';
            } else if ($_GET['page'] == 4) {
               echo '<h1 class="title">Lãng hoa khai trương</h1>';
            } else {
               echo '<h1 class="title">Hoa tươi</h1>';
            }
            ?> -->
      <div class="box-container">

         <?php
         // if (isset($_GET['page'])) {
         //    $page = $_GET['page'];
         // } else {
         //    $page = 1;
         // }


         // $limit = 6; // 10 title per page
         // $start = ($page - 1) * $limit;

         // $total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
         // $total_page = $total_title / $limit;
         // $total_page = ceil($total_title / $limit);


         $query = "SELECT * FROM products LIMIT " . 12 . ", " . 6;
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($result)) {
         ?>
               <form action="" method="POST" class="box">
                  <a href="viewpage.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <input type="number" name="product_quantity" value="1" min="0" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Thêm vào danh sách yêu thích" name="add_to_wishlist" class="option-btn">
                  <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
         }



         ?>

         <?php
         $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $cart_num_rows = mysqli_num_rows($select_cart_count);
         ?>
      </div>
      <div class="icon-cart">
         <i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows ?></span>
      </div>

      <!-- <?php
            echo "<div class=\"pagination\">";
            echo '<a href="#">&laquo;</a> ';
            for ($i = 1; $i <= $total_page; $i++) {
               echo '<a href="home.php?page=' . $i . '">' . $i . '</a>  ';
            }
            echo '<a href="#">&raquo;</a> ';
            echo "</div>";
            ?> -->

   </section>
   <section class="products">
      <h1 class="title">Hoa tặng sinh nhật </h1>
      <!-- <?php
            $page;
            if (!isset($_GET['page'])) {
               $page = 1;
               echo '<h1 class="title">Sản phẩm mới</h1>';
            } else if ($_GET['page'] == 2) {
               echo '<h1 class="title">Sản phẩm nổi bật</h1>';
            } else if ($_GET['page'] == 3) {
               echo '<h1 class="title">Hoa sinh nhật</h1>';
            } else if ($_GET['page'] == 4) {
               echo '<h1 class="title">Lãng hoa khai trương</h1>';
            } else {
               echo '<h1 class="title">Hoa tươi</h1>';
            }
            ?> -->
      <div class="box-container">

         <?php
         // if (isset($_GET['page'])) {
         //    $page = $_GET['page'];
         // } else {
         //    $page = 1;
         // }


         // $limit = 6; // 10 title per page
         // $start = ($page - 1) * $limit;

         // $total_title = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
         // $total_page = $total_title / $limit;
         // $total_page = ceil($total_title / $limit);


         $query = "SELECT * FROM products LIMIT " . 18 . ", " . 6;
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($result)) {
         ?>
               <form action="" method="POST" class="box">
                  <a href="viewpage.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                  <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <input type="number" name="product_quantity" value="1" min="0" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Thêm vào danh sách yêu thích" name="add_to_wishlist" class="option-btn">
                  <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="Chưa có sản phẩm nào được thêm vào!</p>';
         }



         ?>

         <?php
         $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $cart_num_rows = mysqli_num_rows($select_cart_count);
         ?>
      </div>
      <div class="icon-cart">
         <i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows ?></span>
      </div>

      <!-- <?php
            echo "<div class=\"pagination\">";
            echo '<a href="#">&laquo;</a> ';
            for ($i = 1; $i <= $total_page; $i++) {
               echo '<a href="home.php?page=' . $i . '">' . $i . '</a>  ';
            }
            echo '<a href="#">&raquo;</a> ';
            echo "</div>";
            ?> -->

   </section>


   <section>
      <div class="first">
         <h4>TẠI SAO SỬ DỤNG SẢN PHẨM CỦA CHÚNG TÔI</h4>
         -----<i class="fa-solid fa-hand-holding-heart"></i>-----
      </div>
      <div class="uu-dai">

         <div class="second">
            <div class="second-items">
               <img src="img/icon-free-ship.png" alt="" width="70" height="70">
               <div class="content">
                  <p>Có thể giao hàng ở các tỉnh thành lân cận </p>
                  <i>Miễn phí ship khu vực bán kính 5Km </i>
               </div>
            </div>
            <div class="second-items">
               <img src="img/icon-support-247.png" alt="" width="64" height="64">
               <div class="content">
                  <p>Hỗ trợ khách hàng </p>
                  <i>Phục vụ 24/7 </i>
               </div>
            </div>
            <div class="second-items">
               <img src="img/icon-vat.png" alt="" width="64" height="64">
               <div class="content">
                  <p>Thuế VAT</p>
                  <i>Giá đã bao gồm thuế VAT </i>
               </div>
            </div>
            <div class="second-items">
               <img src="img/icon-quick-delivery.png" alt="" width="64" height="64">
               <div class="content">
                  <p>Hoàn thiện đơn và tiến hành giao hàng nhanh chóng </p>
                  <i>Giao hàng nhanh trong ngày </i>
               </div>
            </div>

         </div>
      </div>
   </section>

   <section class="contact" id="contact">

      <!-- <h1 class="heading"> <span> contact us</span>  </h1> -->

      <div class="row">

         <form action="home.php" method="POST">
            <input type="text" placeholder="Tên" class="box" name="name">
            <input type="email" placeholder="Email" class="box" name="email">
            <input type="number" placeholder="Số" class="box" name="number">
            <textarea name="message" class="box" placeholder="Nội dung" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="Gửi tin nhắn" class="btn" name="send">
         </form>

         <div class="image">
            <img src="images/contact-img.svg" alt="">
         </div>

      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <p>Hãy để lại những gì bạn thắc mắc?</p>
         <p> Xin chân thành cảm ơn</p>
         <p>Xử lý lỗi như thế nào?, Hoa giao đi xa còn đảm bảo tươi không?, Thanh toán qua đâu?</p>
         <a href="contact.php" class="btn">Liên hệ với chúng tôi </a>
      </div>

   </section>




   <?php @include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>