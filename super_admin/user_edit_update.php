<?php
require_once('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPassword = isset($_POST['new_password']) && !empty($_POST['new_password']) ? $_POST['new_password'] : '';
    $selectedRoleId = isset($_POST['role_name']) ? $_POST['role_name'] : '';
    $userStatus = isset($_POST['user_status']) ? $_POST['user_status'] : '';
    mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0");

    $updateQuery = "UPDATE admin_accounts SET username = ?, email = ?, user_status = ?";

    if (!empty($newPassword)) {
        $updateQuery .= ", password = ?";
    }

    $updateQuery .= " WHERE user_id = ?";

    $stmt = mysqli_prepare($con, $updateQuery);

    if (!$stmt) {
        die('Prepare failed: ' . mysqli_error($con));
    }

    if (!empty($newPassword)) {
        mysqli_stmt_bind_param($stmt, "sssii", $newUsername, $newEmail, $newPassword, $userStatus, $userId);
    } else {
        mysqli_stmt_bind_param($stmt, "ssii", $newUsername, $newEmail, $userStatus, $userId);
    }

    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        $updateRoleQuery = "UPDATE admin_accounts SET role = ? WHERE user_id = ?";
        $stmtRole = mysqli_prepare($con, $updateRoleQuery);
        if (!$stmtRole) {
            die('Prepare failed for role update: ' . mysqli_error($con));
        }
        mysqli_stmt_bind_param($stmtRole, "ii", $selectedRoleId, $userId);
        $updateRoleResult = mysqli_stmt_execute($stmtRole);

        mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1");

        if ($updateRoleResult) {
            header("Location: user_edit_page.php?user_id=$userId&status=success");
            add_user_log($_SESSION['user_id'], "Updated user '" . $newUsername . "'");
            exit();
        } else {
            echo 'Error updating role: ' . mysqli_error($con);
        }
    } else {
        echo 'Error updating user: ' . mysqli_error($con);
    }
} else {
    echo 'Invalid request.';
}
