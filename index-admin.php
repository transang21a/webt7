<?php

@include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển Quản Trị Responsive | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/style_admin_home.css">
</head>

<body>
    <!-- =============== Điều Hướng ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Tên Thương Hiệu</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Trang Chủ</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Khách Hàng</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Tin Nhắn</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Trợ Giúp</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Cài Đặt</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Mật Khẩu</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Đăng Xuất</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Chính ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Tìm kiếm ở đây">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    
                    <?php 
                    $sex = '';
                    if ($_SESSION['admin_sex'] == 'male'){
                        $sex = 'images/male.png';
                    }
                    else if(  $_SESSION['admin_sex'] == 'female') {
                        $sex = 'images/female';
                    }
                    else {
                        $sex = 'uploaded_img/user-icon.png';
                    }
                         

                    ?>

                    <img src="<?php echo $sex;?>" alt="">
                </div>
            </div>

            <!-- ======================= Thẻ ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Lỗi truy vấn');
                    $number_of_orders = mysqli_num_rows($select_orders);
                        ?>
                        <div class="numbers"><?php echo $number_of_orders;  ?></div>
                        <div class="cardName">Đơn Hàng Đã Đặt</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <?php
                        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Lỗi truy vấn');
                        $number_of_products = mysqli_num_rows($select_products);
                        ?>
                        <div class="numbers"><?php echo  $number_of_products; ?></div>
                        <div class="cardName">Tổng Sản Phẩm</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <?php
                        $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('Lỗi truy vấn');
                        $number_of_messages = mysqli_num_rows($select_messages);
                        ?>
                        <div class="numbers"><?php echo $number_of_messages; ?></div>
                        <div class="cardName">Bình Luận</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <?php
                        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Lỗi truy vấn');

                        $total_sum = 0;
                        while ($number_of_products = mysqli_fetch_assoc($select_products)) {
                            $total_sum += $number_of_products['price'];
                        }
                        ?>
                        <div class="numbers"><?php echo $total_sum; ?></div>
                        <div class="cardName">Tổng Giá Trị</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Danh Sách Chi Tiết Đơn Hàng ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Thông Tin Sản Phẩm</h2>
                        <a href="#" class="btn">Xem Tất Cả</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Tên</td>
                                <td>Giá</td>
                                <td>Chi Tiết</td>
                                <td class="fix_image">Hình Ảnh</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Lỗi truy vấn');

                            if (mysqli_num_rows($select_products) > 0) {
                                while ($product = mysqli_fetch_assoc($select_products)) {
                            ?>
                                    <tr>
                                        <td><?php echo $product['name']; ?></td>
                                        <td><?php echo $product['price']; ?></td>
                                        <td><?php echo $product['details']; ?></td>
                                        <td> <img src="uploaded_img/<?php echo $product['image']; ?>" alt="" class="image"></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

                <!-- ================= Khách Hàng Mới ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Khách Hàng Gần Đây</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="img/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Ý</span></h4>
                            </td>
                        </tr>
                        <?php



                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="js/js_admiin_home.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
