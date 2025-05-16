<?php
include __DIR__ . "/configs/path.php";
session_start();
include __DIR__ . "/conn/conn.php";
// Predefined Admin Credentials
$admin_email = "kukretisantosh6@gmail.com";
$admin_password = "admin123";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Admin Login Check
    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['user_id'] = 0;
        $_SESSION['is_admin'] = true;
        // $_SESSION['success'] = "✅ Admin login successful!";

        header("Location: admin/admin.php"); // Redirect to dashboard
        exit();
    }

    // ✅ Check Database for Regular Users
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = false;
        $_SESSION['success'] = "✅ Login successful! ";

        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error'] = "❌ Invalid email or password!";
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/log_style.css">
    <title>LOGIN</title>
    <style>
        .error-message {
            color: red;
            font-weight: bold;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        body {
            background-color: #f4f7fc;
            font-family: "Arial", sans-serif;
            background: linear-gradient(135deg,
                    #6a11cb,
                    #2575fc,
                    #00b4db,
                    #0083b0) !important;
            animation: gradientAnimation 0.2s ease infinite;

            @keyframes gradientAnimation {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            height: 100vh;
            overflow: hidden;
        }
    </style>
</head>

<body>

    <div class="wrapper">


        <div class="login-page container">
            <div class="img">
                <img src="image/login.png">
            </div>
            <div class="login-container">
                <div class="login-card">
                    <h2>Login</h2>

                    <!-- ✅ Display Error Message in RED -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="error-message"><?php echo $_SESSION['error'];
                                                    unset($_SESSION['error']); ?></div>
                    <?php endif; ?>

                    <!-- ✅ Display Success Message in GREEN -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="success"><?php echo $_SESSION['success'];
                                                unset($_SESSION['success']); ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="emp" style="margin-bottom: 25px;">
                            <label for="email">Email</label><br>
                            <input type="email" id="email" name="email" required placeholder="Enter your email" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
                        </div>
                        <div class="pass emp" style="margin-bottom: 25px;">
                            <label for="password">Password</label><br>
                            <input type="password" id="password" name="password" required placeholder="Enter your password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
                        </div>
                        <div style="text-align: center;">
                            <button class="btn" type="submit" style="padding: 10px 20px;  color: white; border: none; border-radius: 20px; cursor: pointer; margin:15px 0px; font-size: 15px ;">Login</button>
                        </div>
                    </form>

                    <div class="login-footer-links" style="text-align: center; margin-top: 10px;">
                        <p><a href="request_otp.php">Forgot password?</a></p>
                        <p>Don't have an account? <a href="signup.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>