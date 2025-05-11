<?php
session_start();
include __DIR__ . "/conn/conn.php";


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userID = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id =:id");
    $stmt->execute([
        ':id' => $userID
    ]);
    $user = $stmt->fetch();
    if (!$user) {
        $_SESSION['error'] = "Category not found!";
        header("Location:admin/user_info.php");
        exit();
    }
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id ");
    $stmt->execute([
        ':id' => $userID
    ]);
    $_SESSION['success'] = "Category deleted succesfully";
    header("Location:admin/user_info.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location:admin/user_info.php");
    exit();
}
