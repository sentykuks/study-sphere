<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the note id from the URL (example: view.php?id=1)
$note_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch the note from the database
$sql = "SELECT * FROM notes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $note_id);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

$conn->close();

// If note doesn't exist, redirect to download page
if (!$note) {
    header("Location: download.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4"><?php echo htmlspecialchars($note['title']); ?></h1>
        <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($note['description'])); ?></p>

        <?php if ($note['file_path']): ?>
            <div class="mt-4">
                <!-- Display the PDF directly in the browser -->
                <embed src="<?php echo $note['file_path']; ?>" width="100%" height="600px" type="application/pdf">
            </div>
        <?php endif; ?>

        <a href="download.php" class="mt-6 inline-block text-blue-600">Back to Notes</a
