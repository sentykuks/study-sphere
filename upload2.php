<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $file_path = '';

    // File upload handling
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $upload_dir = 'uploads/'; // Ensure this folder exists
        $file_name = time() . "_" . basename($_FILES['file']['name']); // Unique filename
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_path = $upload_dir . $file_name;

        // Move uploaded file
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO notes (title, file_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $file_path);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Note uploaded successfully!";
            } else {
                $_SESSION['error'] = "Error saving to database.";
            }
        } else {
            $_SESSION['error'] = "Failed to move uploaded file.";
        }
    } else {
        $_SESSION['error'] = "No file uploaded or upload error.";
    }

    // Redirect back to admin_dashboard.php
    header("Location: admin/admin.php");
    exit();
}

$conn->close();
?>
