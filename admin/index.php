<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';

?>

<?php
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
  header("location:dashboard.php");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $user_select = "select * from login where email='$email' and password='$password'";
  $user_res = mysqli_query($con, $user_select);
  $user_rec = mysqli_num_rows($user_res);

  // if ($user_rec == 1) {
   
  //   $mail = new PHPMailer(true);

  //   try {
  //     //Server settings
  //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  //     $mail->isSMTP();                                            //Send using SMTP
  //     $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
  //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  //     $mail->Username   = '728d1f2280bfb3';                     //SMTP username
  //     $mail->Password   = '46b8111a8f90d8';                               //SMTP password
  //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  //     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //     //Recipients
  //     $mail->setFrom('appetizer@gmail.com', 'Mailer');
  //     $mail->addAddress($email);     //Add a recipient


  //     //Attachments
  //     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

  //     //Content
  //     $mail->isHTML(true);                                  //Set email format to HTML
  //     $mail->Subject = 'Well come to the APPETIZER';
  //     $mail->Body    = '<h1>'. $email .'</h1>';
  //     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  //     $mail->send();
  //     echo 'Message has been sent';
  //   } catch (Exception $e) {
  //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  //   }
  // }

  if ($user_rec == 1) {
    $user_data = mysqli_fetch_assoc($user_res);
    $_SESSION['user_id'] = $user_data['id'];
    header("location:dashboard.php");
  } else {
    $msg = true;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>appetizer </b>admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><?php if (@$msg) {
                                    echo "<p style='color: red;'>your email and password are worng...!</p>";
                                  } else {
                                    echo "<p style='color: ; '>Sign in to start your session</p>";
                                  } ?></p>

        <form method="post">

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>