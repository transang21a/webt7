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

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        $message[] = 'Đã thêm vào danh sách yêu thích';
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Đã thêm vào giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'Sản phẩm đã được thêm vào danh sách yêu thích';
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
        $message[] = 'Đã thêm vào giỏ hàng';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        mysqli_query($conn, "INSERT INTO `send_email`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
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
    <title>Trang chi tiết sản phẩm</title>
    <link rel="stylesheet" href="css/view_page.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php @include 'header.php'; ?>
    <form action="" method="POST">
        <?php
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>

                    <div class="productss">
                        <div class="img-product">
                            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" width="750" height="750">
                        </div>

                        <div class="titless">
                            <div class="trangchu-sanpham">
                                <a href="home.php">Trang chủ</a>
                                <a href="#"> >>Sản phẩm</a>
                                <h2 class="title-product"><?php echo $fetch_products['name']; ?></h2>
                                <h2 class="price">$<?php echo $fetch_products['price']; ?>/-</h2>
                                <p class="detail"><?php echo $fetch_products['details']; ?>
                                </p>
                                <div class="uu-dai">
                                    <p>✔ Thẻ quà tặng miễn phí, banner in (giá trị 20.000 VND).</p>
                                    <p>✔ In logo/công ty/hình ảnh cá nhân trên banner.</p>
                                    <p>✔ Hỗ trợ giao hàng nhanh trong 2 giờ.</p>
                                </div>
                                <div class="quantity">
                                    <input type="number" min="0" value="1" name="product_quantity">
                                    <div class="add-productss">
                                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                        <input type="submit" value="Thêm sản phẩm yêu thích" name="add_to_wishlist" class="them">
                                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="them">
                                    </div>
                                </div>
                                <div class="uu-dai">
                                    <p>✔ Cần đặt hoa nhanh, vui lòng gọi: 0362 862 340</p>
                                    <p>✔ Hỗ trợ giao hoa nhanh trong 2 giờ kể từ khi hoàn tất thanh toán, hỗ trợ hóa đơn VAT (+10%)</p>
                                    <p>✔ Sản phẩm của chúng tôi luôn mang lại ý nghĩa tốt nhất cho người nhận.</p>
                                </div>
                            </div>
                        </div>
                    </div>
    </form>
<?php
                }
            } else {
                echo '<p class="empty">Không có thông tin sản phẩm!</p>';
            }
        }
?>

<div class="chinhsach-banhang">
    <hr class="gach-ngang">
    <details>
        <summary>Chính sách bán hàng</summary>
        <ul>
            <li>- Miễn phí giao hàng trong khu vực Ngũ Hành Sơn, Đà Nẵng</li>
            <li>- 15.000đ với các quận Cầu Giấy và Bắc Từ Liêm</li>
            <li>- 30.000đ cho các quận Thanh Xuân, Ba Đình và Nam Từ Liêm</li>
            <li>- 50.000đ cho các quận còn lại</li>
        </ul>
        <p>- Giao hoa trong các khu vực của thành phố Đà Nẵng</p>
        <p>- Có hóa đơn đỏ nếu khách hàng yêu cầu.</p>
        <p>- Thiết kế và in banner hoặc thiệp chúc mừng miễn phí (theo yêu cầu của khách hàng)</p>
        <p>- Đội ngũ nhân viên trẻ trung, nhiệt huyết và giàu kinh nghiệm luôn cố gắng làm hài lòng khách hàng.</p>
        <p>- Cửa hàng cam kết hoa chúc mừng được làm theo mẫu đã chọn.</p>
        <p>- Thời gian giao hàng nhanh nhất có thể là 30 phút kể từ khi khách hàng đặt hàng (đối với các đơn hàng gấp, tùy theo yêu cầu và địa chỉ giao hàng).</p>
        <p>- Các mức giá trên chưa bao gồm thuế giá trị gia tăng (VAT).</p>
        <p>- Dễ dàng thanh toán trực tuyến qua thẻ nội địa và quốc tế, Visa, Master, Paypal...</p>
    </details>
    <hr class="gach-ngang">
</div>

<div class="sanpham-tuongtu">
    <h2>Sản phẩm tương tự</h2>
   
    <div class="tongsanpham">

    <?php
        
        $query = "SELECT * FROM products LIMIT " . 1 . ", " . 6;
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
           while ($fetch_products = mysqli_fetch_assoc($result)) {
        ?>
        <div class="sanpham">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" width="250" height="300">
            <p class="tit"><?php echo $fetch_products['name']; ?></p>
            <div class="ngoisao">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="price">$<?php echo $fetch_products['price']; ?>/-</p>
        </div>
       
        <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm nào!</p>';
         }

    ?>
    </div>
</div>
<?php @include 'footer.php'; ?>
</body>

</html>
