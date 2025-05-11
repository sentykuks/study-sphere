<?php
session_start();
// require 'conn/conn.php';
// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {
  $otp = $_POST['otp'];

  // Verify the OTP
  if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp) {
    // OTP is correct, allow user to reset password
    header("Location: reset_password.php");
    exit();
  } else {
    $_SESSION['error'] = "Invalid OTP. Please try again."; // Store error in session
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>OTP Verification</title>
  <link rel="stylesheet" href="css/otp.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/log_style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <style>
    .wrapper {
      width: 100%;
    }
  </style>
</head>

<body>

  <div class="wrapper">

    <div class="login-page container">
      <div class="img">
        <img src="image/login.png" alt="Login Image">
      </div>
      <div class="login-container">
        <div class="login-card">
          <h2>OTP Verification</h2>

          <!-- ✅ Display Error Message in RED -->
          <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="emp" style="margin-bottom: 25px;">
              <label for="otp">Enter OTP</label><br>
              <input type="text" id="otp" name="otp" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="text-align: center;">
              <button class="btn" type="submit" style="padding: 10px 20px;  color: white; border: none; border-radius: 20px; cursor: pointer; margin:15px 0px; font-size: 15px ;">Verify OTP</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</body>

</html>
