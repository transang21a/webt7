<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>
<?php
if (empty($_SESSION['user_name'])) {
    $name = 'Mời bạn đăng nhập';
} else {
    $name = $_SESSION['user_name'];
}
?>
<header class="header">

    <div class="flex">

        <a href="home.php" class="logo"><?php echo   $name; ?></a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="#">Sản phẩm +</a>
                    <ul>
                        <li><a href="index.php?page=1">Sản phẩm mới</a></li>
                        <li><a href="index.php?page=2">Sản phẩm nổi bật</a></li>
                        <li><a href="index.php?page=3">Hoa sinh nhật</a></li>
                        <li><a href="index.php?page=4">Hoa khai trương</a></li>
                        <li><a href="index.php?page=5">Hoa tươi</a></li>
                    </ul>
                </li>
                <li><a href="#">Trang +</a>
                    <ul>
                        <li><a href="about.php">Giới thiệu</a></li>
                        <li><a href="contact.php">Liên hệ</a></li>
                    </ul>
                </li>
                <li><a href="shop.php">Cửa hàng</a></li>
                <li><a href="orders.php">Đơn hàng</a></li>
                <li><a href="#">Tài khoản +</a>
                    <ul>
                        <li><a href="login_new.php">Đăng nhập</a></li>
                        <li><a href="login_new.php">Đăng ký</a></li>
                        <li><a href="logout.php">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
            $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <p>Tên người dùng: <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>

            <a href="logout.php" class="delete-btn">Đăng xuất</a>
            <a href="profile.php" class="delete-btn">Thông tin cá nhân</a>
        </div>

    </div>

</header>
