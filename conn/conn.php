<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default is empty in XAMPP
$dbname = "base";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
