<?php
require "../git_clone/PHPMailer/src/PHPMailer.php";  // Nhúng thư viện PHPMailer vào để sử dụng, sửa lại đường dẫn cho đúng nếu bạn lưu vào vị trí khác
require "../git_clone/PHPMailer/src/SMTP.php"; // Nhúng thư viện SMTP vào để sử dụng
require '../git_clone/PHPMailer/src/Exception.php'; // Nhúng thư viện Exception vào để sử dụng

// true: bật chế độ ngoại lệ
use PHPMailer\PHPMailer\PHPMailer;
@include 'config.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_mess = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$id'") or die('Lỗi truy vấn');
    $fetch_mess = mysqli_fetch_assoc($select_mess);

    session_start();
    $user_id = $_SESSION['user_id'];

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
        $to = $fetch_mess['email'];
        $to_name = $fetch_mess['name'];

        $mail->addAddress($to, $to_name); // Thêm email và tên người nhận
        $mail->isHTML(true);  // Đặt định dạng email là HTML
        $mail->Subject = 'Mail xác nhận đặt hàng thành công';
        $noidungthu = "<b>Chào bạn! </b>" . $fetch_mess['name'] . "<b><br>Shop cảm ơn bạn đã đặt hoa của cửa hàng!</b> " . "<br>"
        ."Tổng tiền của bạn là " . $fetch_mess['total_price']."$" . "<br>Ngày đặt hàng là: ". $fetch_mess['placed_on'];
        $mail->Body = $noidungthu;
        // $mail->AddAttachment("uploaded_img/user-icon.png", "picture");

        $cart_query = mysqli_query($conn, "SELECT * FROM `send_email` WHERE user_id = '$user_id'") or die('Lỗi truy vấn');
        if(mysqli_num_rows($cart_query) > 0){
            while($cart_item = mysqli_fetch_assoc($cart_query)){
                $a = $cart_item['image'];
                $mail->AddAttachment("uploaded_img/$a", "picture");
            }
        }

        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        echo 'Đã gửi mail thành công';
        // mysqli_query($conn, "DELETE  FROM `send_email`") or die('Lỗi truy vấn');
    } catch (Exception $e) {
        echo 'Không thể gửi mail. Lỗi: ', $mail->ErrorInfo;
    }
}
echo '<br>';
echo $a;
?>
