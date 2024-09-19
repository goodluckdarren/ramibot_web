<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tuition_id'])) {
    $tuition_id = $_POST['tuition_id'];

    $fetch_query = "SELECT img_url FROM tuition_img WHERE tuition_id = ?";
    $stmt = mysqli_prepare($con, $fetch_query);
    mysqli_stmt_bind_param($stmt, 'i', $tuition_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $img_url);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($img_url) {
        if (file_exists($img_url)) {
            if (unlink($img_url)) {
                echo "Image file deleted successfully from the directory.<br>";
            } else {
                echo "Error deleting the image file from the directory.<br>";
            }
        } else {
            echo "File does not exist in the directory.<br>";
        }

        $delete_query = "DELETE FROM tuition_img WHERE tuition_id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, 'i', $tuition_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image record has been deleted successfully from the database.';
            add_user_log($_SESSION['user_id'], "Deleted tuition image with ID '" . $tuition_id . "'");
        } else {
            echo "Error deleting image record from the database: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "No image found with the provided tuition_id.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($con);
?>
