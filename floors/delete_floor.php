<?php
    require_once('../database_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $floor_id = $_POST['floor_id'];
        
        // Delete related data from floor_map table
        $delete_query = "DELETE FROM floor_map WHERE floor_id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, 'i', $floor_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image has been deleted successfully.';
        } else {
            echo "Error deleting image: " . mysqli_error($con);
        } 
    }
?>
