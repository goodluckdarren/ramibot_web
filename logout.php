<?php
// Check if the user is logged in by checking session variables
if (isset($_SESSION['user_id'])) {
    // Include database connection and logging scripts
    require_once('database_connect.php');
    require_once('scripts/user_logs.php');

    // Log the logout action
    add_user_log($_SESSION['user_id'], "Logged out");

    // Unset all session variables to effectively log out the user
    $_SESSION = [];

    // Destroy the session to clear all session data
    session_destroy();
}

// Redirect to the login page
header("Location: login/login.php");
exit();
?>
