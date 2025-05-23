<?php
session_start();
include __DIR__ . "/conn/conn.php";
require 'send_welcome_email.php'; // Include the send email function 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $raw_password = $_POST['password'];
    $name = trim($_POST['name']);

    if (empty($email) || empty($raw_password) || empty($name)) {
        $_SESSION['errorMessage'] = "Please fill in all fields.";
    } else {
        // Check if email is already in use 
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['errorMessage'] = "Email is already taken.";
        } else {
            // Hash the password and insert new user
            $password = password_hash($raw_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
            $stmt->execute([$email, $password, $name]);

            // Send Welcome Email
            sendWelcomeEmail($email, $name);

            $_SESSION['successMessage'] = "You have successfully registered! You can now log in.";
            header("Location: signup.php");
            exit();
        }
    }
}

// Capture and unset messages
$successMessage = $_SESSION['successMessage'] ?? '';
$errorMessage = $_SESSION['errorMessage'] ?? '';
unset($_SESSION['successMessage'], $_SESSION['errorMessage']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/log_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc, #00b4db, #0083b0);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: auto;
        }

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
    </style>
</head>

<body>
    <div class="login-page d-flex align-items-center justify-content-center" style="min-height: 100vh; width: 100% ;">
        <div class="signup-container row d-flex align-items-center" style="width: 100% ;">
            <div class="img col-4 ms-5">
                <img src="image/signup.webp" alt="Signup Image" style="max-width: 350px;">
            </div>

            <!-- Bootstrap Alerts for messages -->
            <div class="col-lg-4 ms-5">
                <?php if (!empty($successMessage)) : ?>
                    <div class="alert alert-success w-75 text-center fw-bold" style="width: 390px;">
                        <?= htmlspecialchars($successMessage) ?>
                    </div>
                <?php elseif (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger  text-center fw-bold" style="width: 390px;">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>
                <div class="signup-card bg-white py-4 rounded shadow" style="min-width: 300px;">

                    <h3 class="mb-4 text-center">Create an Account</h3>
                    <form method="POST" action="signup.php" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required minlength="3" maxlength="50"
                                placeholder = "Enter your name" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter your email"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required minlength="6"
                                placeholder="Create a password" title="Password must be at least 6 characters long">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Register</button>
                    </form>
                    <div class="footer-links text-center mt-3">
                        <p>Already have an account? <a href="index.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>