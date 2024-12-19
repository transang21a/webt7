<?php
require "../git_clone/PHPMailer/src/PHPMailer.php";  // Nhúng thư viện PHPMailer vào để sử dụng, sửa lại đường dẫn cho đúng nếu bạn lưu vào vị trí khác
require "../git_clone/PHPMailer/src/SMTP.php"; // Nhúng thư viện SMTP vào để sử dụng
require '../git_clone/PHPMailer/src/Exception.php'; // Nhúng thư viện Exception vào để sử dụng

// true: bật chế độ ngoại lệ
use PHPMailer\PHPMailer\PHPMailer;
@include 'config.php';
session_start();

$email = $_SESSION['email'];

$select_mess = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Lỗi truy vấn');
$fetch_mess = mysqli_fetch_assoc($select_mess);

$mail = new PHPMailer;
try {
    $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. Khi mọi cấu hình đều đúng thì chỉnh lại 0
    $mail->isSMTP();
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  // Máy chủ SMTP
    $mail->SMTPAuth = true; // Bật xác thực
    $nguoigui = 'uyenuyen100103@gmail.com';
    $matkhau = 'qzkhsmtsosrupsku'; // Mật khẩu ứng dụng đã tạo ở bước 3
    $tennguoigui = 'UYên';
    $mail->Username = $nguoigui; // Tên người dùng SMTP
    $mail->Password = $matkhau;   // Mật khẩu SMTP
    $mail->SMTPSecure = 'ssl';  // Mã hóa SSL/TLS 
    $mail->Port = 465;  // Cổng kết nối
    $mail->setFrom($nguoigui, $tennguoigui);
    $to = $email;
    $to_name = $fetch_mess['name'];

    $mail->addAddress($to, $to_name); // Thêm email và tên người nhận
    $mail->isHTML(true);  // Đặt định dạng email là HTML
    $mail->Subject = 'Mail thiết lập lại mật khẩu đăng nhập website bán hoa ';
    $pass = mysqli_real_escape_string($conn, $fetch_mess['password']);
   $noidungthu = "<b>Chào bạn!</b>"."  " . " <strong> {$fetch_mess['name']} </strong>". "<br>"  ."Mã mật khẩu của bạn là: ".  "<strong>$pass</strong>" ."<br>" ;
    $mail->Body = $noidungthu;
    // $mail->AddAttachment("uploaded_img/user-icon.png", "picture");

    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));
    $mail->send();
    echo 'Đã gửi mail thành công';
    header("location: login_new.php");

} catch (Exception $e) {
    echo 'Không thể gửi mail. Lỗi: ', $mail->ErrorInfo;
}

echo '<br>';

?>
