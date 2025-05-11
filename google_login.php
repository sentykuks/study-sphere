<?php
session_start();
include('db.php');

// Google client ID from Google Developer Console
$googleClientId = '407328209521-758aksskph2krkigggsee5qsa3bnm2j6.apps.googleusercontent.com';
$googleClientSecret = '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';
$redirectUri = 'http://localhost/your_project/google_oauth_callback.php'; // Replace with your actual URL

// Load the Google API Client Library
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId($googleClientId);
$client->setClientSecret($googleClientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');

// If the user is redirected back from Google, handle the authentication
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get(); // Get user info from Google

    $googleId = $userInfo->id;
    $email = $userInfo->email;
    $name = $userInfo->name;

    // Check if the user is already in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
    $stmt->execute([$googleId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, log them in
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: profile.php");
    } else {
        // New user, register them
        $stmt = $pdo->prepare("INSERT INTO users (google_id, email, name) VALUES (?, ?, ?)");
        $stmt->execute([$googleId, $email, $name]);

        // Fetch the inserted user data
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['email'] = $email;

        // Redirect to the profile page
        header("Location: profile.php");
    }
} else {
    // Redirect to Google login page
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
}
?>
