<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

  $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $email = mysqli_real_escape_string($conn, $filter_email);
  $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
  $pass = mysqli_real_escape_string($conn, $filter_pass);

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('truy vấn thất bại');


  if (mysqli_num_rows($select_users) > 0) {

    $row = mysqli_fetch_assoc($select_users);

    if ($row['user_type'] == 'admin') {

      $_SESSION['admin_name'] = $row['name'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id'];
      // $_SESSION['admin_sex'] = $row['sex'];
      header('location:admin_page.php');
    } elseif ($row['user_type'] == 'user') {

      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_sex'] = $row['sex'];
      $_SESSION['pass'] = $row['password'];
      $_SESSION['type_id'] = $row['user_type'];

      header('location:index.php');
    } else {
      $message[] = 'Không tìm thấy người dùng!';
    }
  } else {
    $message[] = 'Email hoặc mật khẩu không chính xác!';
  }
}

if (isset($_POST['submit_sign_up'])) {

  $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $name = mysqli_real_escape_string($conn, $filter_name);
  $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $email = mysqli_real_escape_string($conn, $filter_email);
  $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
  $pass = mysqli_real_escape_string($conn, $filter_pass);
  $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
  $cpass = mysqli_real_escape_string($conn, $filter_cpass);
  $filter_sex = filter_var($_POST['sex'], FILTER_SANITIZE_STRING);
  $sex = mysqli_real_escape_string($conn, $filter_sex);
  $type = 'user';
  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('truy vấn thất bại');

  if (mysqli_num_rows($select_users) > 0) {
    $message[] = 'Người dùng đã tồn tại!';
  } else {
    if ($pass != $cpass) {
      $message[] = 'Mật khẩu xác nhận không khớp!';
    } else {
      mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, sex) VALUES('$name', '$email', '$pass', '$type', '$sex')") or die('truy vấn thất bại');
      $message[] = 'Đăng ký thành công!';
      header('location:login_new.php');
    }
  }
}

?>



<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style_login.css" />
  <title>Đăng nhập & Đăng ký</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- Đăng nhập -->

        <form action="login_new.php" class="sign-in-form" method="POST">
          <h2 class="title">Đăng nhập</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Nhập email của bạn" name="email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Nhập mật khẩu của bạn" name="pass" />
          </div>
          <input type="submit" value="Đăng nhập" class="btn solid" name="submit" />
          <a href="forgot_password.php" class="btn solid" style="text-decoration: none; box-sizing:border-box ; padding-top: 0.8rem; padding-left: 0.5rem;">Quên mật khẩu</a>
          <p class="social-text">Hoặc đăng nhập với các nền tảng mạng xã hội</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>

        <!-- Đăng ký -->

        <form action="login_new.php" class="sign-up-form" method="POST">
          <h2 class="title">Đăng ký</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nhập tên người dùng" name="name" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Nhập email của bạn" name="email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Nhập mật khẩu của bạn" name="pass" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Xác nhận mật khẩu" name="cpass" />
          </div>
          <div class="input-field">
            <i class="fa fa-comment"></i>
            <select name="sex" id="">
              <option value="male">Nam</option>
              <option value="female">Nữ</option>
              <option value="other">Khác</option>
            </select>
          </div>
          <input type="submit" class="btn" value="Đăng ký" name="submit_sign_up" />
          <p class="social-text">Hoặc đăng ký với các nền tảng mạng xã hội</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Thành viên mới ?</h3>
          <p>
          Bắt đầu hành trình của bạn ngay hôm nay!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Đăng ký
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Đã là thành viên ?</h3>
          <p>
          Đăng nhập để tiếp tục hành trình của bạn!
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Đăng nhập
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
</body>

</html>
