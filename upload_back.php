<!-- <.......................upload back condition..........................> -->
<?php
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    // $description = $_POST['description'];
    $file_path = '';

    // Handle PDF file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_name = basename($_FILES['file']['name']);
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_path = 'uploads/' . $file_name;

        // Move the file to the "uploads" directory
        move_uploaded_file($file_tmp, $file_path);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO notes (title, description, file_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $file_path);
    $stmt->execute();

    echo "<p class='text-green-700 text-center'>Notes uploaded successfully!</p>";
}

$conn->close();
?>