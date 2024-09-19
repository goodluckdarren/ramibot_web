<?php
session_start(); // Start the session

require_once('database_connect.php');
require_once('logout_log.php');   

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; 
    $action = 'Logged out';

    add_user_log($userId, $action);
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

header("Location: login/login.php"); 
exit();
?>
