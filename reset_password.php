<?php
session_start();
include __DIR__."/conn/conn.php";
// Check if OTP exists in session
if (!isset($_SESSION['otp'])) {
    header("Location: request_otp.php"); // If OTP is not set in session, redirect to OTP request
    exit();
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($new_password == $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed_password, $_SESSION['email']]);

        // Clear OTP and email from session
        unset($_SESSION['otp']);
        unset($_SESSION['email']);

        // Redirect to login page with a success message
        header("Location: index.php?message=Password updated successfully.");
        exit();
    } else {
        $error = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap 5 CSS -->
     <!-- <link rel="stylesheet" href="css/reset_password.cssv=<?php echo time(); ?>">  -->
     <link rel="stylesheet" href="css/home_style.css?v=<?php echo time(); ?>">
     <link rel="stylesheet" href="css/log_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  
<div class="wrapper">
<nav style="background: transparent;">
        <div class ="menu-bar container flex">
        <div class="logo">
          <label><a href="#">STUDY SPHERE</a></label>
        </div>
        <ul class="flex">
          <li><a href="#">Home</a></li>
          <li>
            <a href="">About </a>
            <!-- <ul class="submenu flex">
              <li><a href="#">Blog</a></li>
              <li><a href="#">Blog Details</a></li>
              <li><a href="#">Elements</a></li>
            </ul> -->
          </li>
          <li>
            <a href="#">Univercity</a>
            <ul class="submenu flex">
             
            </ul>
          </li>
          <!-- <li>
            <a href="#">BLOG </a>
            <ul class="submenu flex">
              <li><a href="#">Blog</a></li>
              <li><a href="#">Blog Details</a></li>
              <li><a href="#">Elements</a></li>
            </ul>
          </li> -->
          <li><a href="">Contact</a></li>
          <!-- <li class="primary-button">
            <a href="#" class="link-hover">Sign-in</a>
          </li> -->
          <li class="secondary-button">
            <a href="signup.ph">Sign-up</a>
          </li>
        </ul>
        <div class="icon-bar">
          <input type="checkbox" id="check" />
          <label for="check"> <i class="fa fa-bars"></i></label>
        </div>
      </div>
    </nav>
    <div class="img"></div>

<br>
        <div class="nav-button">
            <!-- <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button> -->
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
    <div class="bg-image">

     <!-- <img src="image/upload_section.png" alt=""> -->
     <div class="login-page container">
     <div class="img">
        <img src="image/login.png">
      </div>
      </div>
<br>
    <!-- Password Reset Form -->
    <div class="container" style="margin-left: 30px">
        <div class="card col-lg-6 col-md-8 col-sm-12">
            <div class="card-header">
                <strong>Reset Your Password</strong>
            </div>
            <div class="card-body">
                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Enter your new password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirm your new password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </form>

                <div class="mt-3 text-center">
                    <p>Remember your password? <a href="index.php" class="footer-link">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
