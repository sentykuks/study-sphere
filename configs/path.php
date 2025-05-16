<?php
// Detect protocol (HTTP or HTTPS)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

// Get server name (localhost or domain)
$server_name = $_SERVER['SERVER_NAME'];

// Define the project folder (Change 'gup' to your actual folder name)
$project_folder = "gup";

// Generate full base URL
$base_url = $protocol . "://" . $server_name . "/" . $project_folder . "/";
