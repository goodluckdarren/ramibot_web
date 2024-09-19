<?php
require_once '../database_connect.php';
require_once('../scripts/user_logs.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    if (empty($userId) || !is_numeric($userId)) {
        die('Invalid user ID.');
    }

    if (!mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0")) {
        die('Failed to disable foreign key checks: ' . mysqli_error($con));
    }

    $deleteQuery = "DELETE FROM admin_accounts WHERE user_id = ?";

    $stmt = mysqli_prepare($con, $deleteQuery);

    if (!$stmt) {
        die('Prepare failed: ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);

    $deleteResult = mysqli_stmt_execute($stmt);
    $username = $_POST['username']; 

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "User deleted successfully.";
        add_user_log($_SESSION['user_id'], "Deleted user '" . $username . "'");
        echo '<br><button onclick="goBack()">Okay</button>';
    } else {
        echo "Error deleting user or user not found: " . mysqli_error($con);
    }

    if (!mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1")) {
        die('Failed to re-enable foreign key checks: ' . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}

mysqli_close($con);
