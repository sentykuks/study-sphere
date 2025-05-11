<?php
session_start();
include __DIR__ . "/conn/conn.php";
require 'send_welcome_email.php'; // Include the send email function 

// Initialize variables for messages
$successMessage = '';
$error = '';

// Check if form is submitted 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];

    // Check if the form fields are filled
    if (empty($email) || empty($password) || empty($name)) {
        $error = "Please fill in all fields.";
    } else {
        // Check if email is already in use 
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
    }
    if ($stmt->rowCount() > 0) {
        $error = "Email is already taken.";
    } else {
        // Insert user into the database 
        $stmt = $pdo->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
        $stmt->execute([$email, $password, $name]);
        
        // Send Welcome Email 
        sendWelcomeEmail($email, $name); // Call the function to send the email 
        
        $successMessage = "You have successfully registered! You can now log in.";
        
        // Redirect to login page after a slight delay
        header("refresh:3;url=signup.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>SIGN UP</title>
    <link rel="stylesheet" href="css/log_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5.3 JavaScript Bundle (including Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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
        <div class="img"></div>
        <br>
        <div class="nav-button">
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
        </nav>
        <div class="login-page">
            <div class="img">
                <img src="image/signup.webp">
            </div>
            <div class="signup-container  d-flex justify-content-end">
                <div class="signup-card">
                    <h3>Create an Account</h3>
                    <form method="POST" action="signup.php" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required minlength="3" maxlength="50"
                                placeholder="Enter your name" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
                        </div>
                        <div class="mb-3 emp2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter your email"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required minlength="6"
                                placeholder="Create a password" title="Password must be at least 6 characters long">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Register</button>
                    </form>
                    <div class="footer-links d-flex mt-2 justify-content-center">
                        <p>Already have an account? <a href="index.php">Login </a></p>
                    </div>
                </div>
            </div>
            <!-- Notification Area -->
            <div class="col-4">
            <div class="notification <?= !empty($successMessage) ? 'success' : (!empty($error) ? 'error' : '') ?>">
                <?= !empty($successMessage) ? $successMessage : $error ?>
            </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // Show notification if there is a message
                document.addEventListener("DOMContentLoaded", function() {
                    const notification = document.querySelector('.notification');
                    if (notification.innerText.trim() !== '') {
                        notification.style.display = 'block';
                        setTimeout(() => {
                            notification.style.display = 'none'; // Hide after 5 seconds
                        }, 5000);
                    }
                });
            </script>
        </div>
</body>

</html>
