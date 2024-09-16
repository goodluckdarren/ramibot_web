<?php
session_start(); // Start the session

// Include the necessary files for database connection and logging
require_once('database_connect.php'); // Adjust the path based on your project structure
require_once('logout_log.php');   // Adjust the path based on your project structure

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session
    $action = 'Logged out';

    // Log the logout action using the custom function
    add_user_log($userId, $action);
}

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the login page or home page
header("Location: login/login.php"); // Change 'login.php' to your actual login page
exit();
?>
