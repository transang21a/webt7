<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login_new.php');
};

if (isset($_POST['add_to_wishlist'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Lỗi truy vấn');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Lỗi truy vấn');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        $message[] = 'Sản phẩm đã được thêm vào danh sách yêu thích';
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('Lỗi truy vấn');
        $message[] = 'Sản phẩm đã được thêm vào danh sách yêu thích';
    }
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Lỗi truy vấn');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ hàng';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Lỗi truy vấn');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Lỗi truy vấn');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Lỗi truy vấn');
        $message[] = 'Sản phẩm đã được thêm vào giỏ hàng';
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem nhanh</title>

    <!-- Liên kết font awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Liên kết tệp CSS quản trị viên tùy chỉnh  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="quick-view">

        <h1 class="title">Chi tiết sản phẩm</h1>

        <?php
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('Lỗi truy vấn');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                    <form action="" method="POST">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                        <div class="details"><?php echo $fetch_products['details']; ?></div>
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
                echo '<p class="empty">Không có chi tiết sản phẩm!</p>';
            }
        }
        ?>

        <div class="more-btn">
            <a href="home.php" class="option-btn">Quay lại trang chủ</a>
        </div>

    </section>

    <section class="products">
      <h1 class="title">SẢN PHẨM HOT</h1>

      <div class="box-container">

         <?php
        
         $query = "SELECT * FROM products LIMIT " . 1 . ", " . 6;
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($result)) {
         ?>
               <form action="" method="POST" class="box">
                  <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
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
            echo '<p class="empty">Chưa có sản phẩm nào được thêm!</p>';
         }
         ?>

         <?php
         $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Lỗi truy vấn');
         $cart_num_rows = mysqli_num_rows($select_cart_count);
         ?>
      </div>
      <div class="icon-cart">
         <i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows ?></span>
      </div>

   </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>
