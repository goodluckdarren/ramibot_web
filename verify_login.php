<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Notify user to login
    echo "<script>alert('Please login to access this page');</script>";
    echo "<script>window.location.href='../login/login.php';</script>"; // Redirect to login page if not logged in
    exit();
}

// Prevent caching of this page
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
