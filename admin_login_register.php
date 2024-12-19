<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

  $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $email = mysqli_real_escape_string($conn, $filter_email);
  $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
  $pass = mysqli_real_escape_string($conn, $filter_pass);

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


  if (mysqli_num_rows($select_users) > 0) {

    $row = mysqli_fetch_assoc($select_users);

    if ($row['user_type'] == 'admin') {

      $_SESSION['admin_name'] = $row['name'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id'];
      $_SESSION['admin_sex'] = $row['sex'];
      header('location:admin_page.php');
    }  else {
      $message[] = 'Không tìm thấy người dùng!';
    }
  } else {
    $message[] = 'Email hoặc mật khẩu không đúng!';
  }
}

if(isset($_POST['submit-up'])){

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

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

  if(mysqli_num_rows($select_users) > 0){
     $message[] = 'Người dùng đã tồn tại!';
  }else{
     if($pass != $cpass){
        $message[] = 'Mật khẩu xác nhận không khớp!';
     }else{
       $ad = 'admin';
       $type_ad = filter_var($ad, FILTER_SANITIZE_STRING);
       $type = mysqli_real_escape_string($conn,  $type_ad);
        mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, sex) VALUES('$name', '$email', '$pass', '$type', '$sex')") or die('query failed');
        $message[] = 'Đăng ký thành công!';
        header('location:admin_login_register.php');
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
  <title>Đăng nhập & Đăng ký Quản trị viên</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- đăng nhập -->

        <form action="admin_login_register.php" class="sign-in-form" method="POST">
          <h2 class="title">Đăng nhập Quản trị viên</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Nhập Email của bạn" name="email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Nhập Mật khẩu của bạn" name="pass" />
          </div>
          <input type="submit" value="Đăng nhập" class="btn solid" name="submit" />
          <p class="social-text">Hoặc đăng nhập với các nền tảng xã hội</p>
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

        <!-- đăng ký -->

        <form action="admin_login_register.php" class="sign-up-form" method="POST">
          <h2 class="title">Đăng ký Quản trị viên</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nhập Tên người dùng" name="name" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Nhập Email của bạn" name="email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Nhập Mật khẩu của bạn" name="pass" />
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
         <input type="submit" class="btn" value="Đăng ký" name="submit-up" />
          <p class="social-text">Hoặc đăng ký với các nền tảng xã hội</p>
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
          <h3>Mới đến?</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
            ex ratione. Aliquid!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Đăng ký
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Đã là một thành viên?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
            laboriosam ad deleniti.
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
