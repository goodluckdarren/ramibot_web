<?php
    require_once('../database_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $calendar_id = $_POST['calendar_id'];
        
        // Delete related data from floor_map table
        $delete_query = "DELETE FROM calendars_img WHERE calendar_id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, 'i', $calendar_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image has been deleted successfully.';
        } else {
            echo "Error deleting image: " . mysqli_error($con);
        } 
    }
?>
