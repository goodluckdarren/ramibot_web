<?php

require_once '../database_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Check if the user ID is valid
    if (empty($userId) || !is_numeric($userId)) {
        die('Invalid user ID.');
    }

    // Disable foreign key checks for the delete
    if (!mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0")) {
        die('Failed to disable foreign key checks: ' . mysqli_error($con));
    }

    // Prepare the query with placeholders to prevent SQL injection
    $deleteQuery = "DELETE FROM admin_accounts WHERE user_id = ?";

    // Initialize the prepared statement
    $stmt = mysqli_prepare($con, $deleteQuery);

    if (!$stmt) {
        die('Prepare failed: ' . mysqli_error($con));
    }

    // Bind the parameters to the query
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the query
    $deleteResult = mysqli_stmt_execute($stmt);

    // Re-enable foreign key checks
    if (!mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1")) {
        die('Failed to re-enable foreign key checks: ' . mysqli_error($con));
    }

    if ($deleteResult) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($con);
