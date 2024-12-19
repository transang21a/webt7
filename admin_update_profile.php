<?php

@include 'config.php';

session_start();

$user_id = '';

if (isset($_SESSION['admin_id'])) {
   $admin_id = $_SESSION['admin_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if (!empty($name)) {
      mysqli_query($conn, "UPDATE `users` SET name = '$name' WHERE id = '$admin_id'") or die('query failed');
   }

   mysqli_query($conn, "UPDATE `users` SET email = '$email' WHERE id = '$admin_id'") or die('query failed');

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

   $fetch_prev =  mysqli_query($conn, "SELECT password FROM `users` WHERE id = '$admin_id'") or die('query failed');
   $fetch_prev_pass = mysqli_fetch_assoc($fetch_prev);

   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if ($old_pass != $empty_pass) {
      if ($new_pass != $confirm_pass) {
         $message[] = 'Confirm password does not match!';
      } else {
         if ($new_pass != $empty_pass) {
            mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$admin_id'") or die('query failed');
            $message[] = 'Password updated successfully!';
         } else {
            $message[] = 'Please enter a new password!';
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile Admin</title>

   <!-- Font awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- Header section starts -->
   <?php include 'header.php'; ?>
   <!-- Header section ends -->

   <section class="form-container update-form">

      <form action="" method="post">
         <h3>Update Profile Admin</h3>
         <input type="text" name="name" placeholder="<?= $_SESSION['admin_name'] ?>" class="box" maxlength="50">
         <input type="email" name="email" placeholder="<?= $_SESSION['admin_email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="old_pass" placeholder="Enter your old password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="new_pass" placeholder="Enter your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="confirm_pass" placeholder="Confirm your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="Update Now" name="submit" class="btn">
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- Custom JS file link -->
   <script src="js/script.js"></script>

</body>

</html>
