<?php
session_start();
include __DIR__ . "/conn/conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files (adjust the path if necessary)
require 'vendor/autoload.php';  // If you're using Composer, this will load PHPMailer

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate OTP (One-Time Password)
        $otp = rand(100000, 999999);

        // Store OTP in session for validation later
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP to user's email using PHPMailer
        $mail = new PHPMailer(true);  // Create an instance of PHPMailer

        try {
            // Server settings
            $mail->isSMTP();  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = 'anandpaswan4812@gmail.com';  // Your Gmail address
            $mail->Password = 'dxoq pbag pgtj ijaw';  // Your Gmail password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
            $mail->Port = 587;  // TCP port for Gmail SMTP

            // Recipients
            $mail->setFrom('anandpaswan4812@gmail.com', 'studysphere');  // Sender's email address
            $mail->addAddress($email);  // Recipient's email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP';
            $mail->Body    = "Your OTP for password reset is: <strong>$otp</strong>";

            // Send the email
            $mail->send();

            // Redirect to OTP verification page
            header("Location: verify_otp.php");
            exit();
        } catch (Exception $e) {
            // Handle any errors during the sending process
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request OTP</title>
    <?php include __DIR__ . "/common/css.php" ?>
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <!-- Main Image (Background) -->
        <div class="img"></div>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="image-section"><img src="image/forget_password.png" alt=""></div>
            <div class="card col-lg-6 col-md-8 col-sm-12">
                <div class="card-forget">
                    <strong>Forget Your Password</strong>
                </div>
                <div class="card-body">
                    <p>Enter your registered email, and we'll send you a reset link.</p>
                    <?php if (isset($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    } ?>

                    <!-- OTP Request Form -->
                    <form method="POST">
                        <div class="mb-3 otp">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your registered email">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Request OTP</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p class="text-center"><a href="index.php">Back to Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript (Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
