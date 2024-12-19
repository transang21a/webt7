<?php

@include 'config.php'; // Kết nối với tệp cấu hình

session_start(); // Bắt đầu phiên làm việc

$user_id = $_SESSION['user_id']; // Lấy ID người dùng từ phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa sẽ chuyển hướng tới trang đăng nhập
if(!isset($user_id)){
   header('location:login_new.php');
};

// Kiểm tra nếu người dùng đã gửi tin nhắn
if(isset($_POST['send'])){

    // Lấy dữ liệu từ form và tránh các ký tự đặc biệt trong cơ sở dữ liệu
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    // Kiểm tra nếu tin nhắn đã được gửi trước đó
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('lỗi truy vấn');

    // Nếu tin nhắn đã gửi, hiển thị thông báo
    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'Tin nhắn đã được gửi trước!';
    }else{
        // Nếu chưa gửi, thêm tin nhắn vào cơ sở dữ liệu
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('lỗi truy vấn');
        $message[] = 'Tin nhắn đã được gửi thành công!';
    }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liên hệ</title>

   <!-- Liên kết tới Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Liên kết tới tệp CSS tùy chỉnh -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Liên hệ với chúng tôi</h3>
    <p> <a href="home.php">Trang chủ</a> / Liên hệ </p>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>Gửi tin nhắn cho chúng tôi!</h3>
        <input type="text" name="name" placeholder="Nhập tên của bạn" class="box" required> 
        <input type="email" name="email" placeholder="Nhập email của bạn" class="box" required>
        <input type="number" name="number" placeholder="Nhập số điện thoại của bạn" class="box" required>
        <textarea name="message" class="box" placeholder="Nhập tin nhắn của bạn" required cols="30" rows="10"></textarea>
        <input type="submit" value="Gửi tin nhắn" name="send" class="btn">
    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
