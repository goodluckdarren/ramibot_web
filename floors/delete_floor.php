<?php
    require_once('../database_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_POST['ID_Number'];
        // Get user data before deleting
        $select_query = "SELECT * FROM  WHERE floor_id = ?";
        $stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        // Delete related data from user_list table
        $delete_query2 = "DELETE FROM ramibot_faces WHERE ID_Number = ?";
        $stmt4 = mysqli_prepare($con, $delete_query2);
        mysqli_stmt_bind_param($stmt4, 'i', $user_id);
        mysqli_stmt_execute($stmt4);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'User has been deleted successfully.';
        } else {
            echo "Error deleting user: " . mysqli_error($con);
        } 
    }
?>