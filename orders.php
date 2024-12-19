<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login_new.php');
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đơn hàng</title>

   <!-- Liên kết font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Liên kết tệp CSS tùy chỉnh cho admin -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Đơn hàng của bạn</h3>
    <p> <a href="home.php">Trang chủ</a> / Đơn hàng </p>
</section>

<section class="placed-orders">

    <h1 class="title">Đơn hàng đã đặt</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Truy vấn thất bại');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> Đặt vào lúc : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> Tên : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
        <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
        <p> Đơn hàng của bạn : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
        <p> Tổng giá : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
        <p> Tình trạng thanh toán : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    <div class="send-mail">
    <a class="send-mail" href="send_mail.php?id=<?php echo $fetch_orders['id']?>">Gửi email</a>

    </div>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">Chưa có đơn hàng nào!</p>';
    }
    ?>
    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
