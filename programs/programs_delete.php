<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['img_id'])) {
    $img_id = $_POST['img_id'];

    // Fetch the image URL before deleting the record
    $fetch_query = "SELECT img_url FROM programs_img WHERE img_id = ?";
    $stmt = mysqli_prepare($con, $fetch_query);
    mysqli_stmt_bind_param($stmt, 'i', $img_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $img_url);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // If an image URL was found
    if ($img_url) {
        // Attempt to delete the file from the directory
        if (file_exists($img_url)) {
            if (unlink($img_url)) {
                echo "Image file deleted successfully from the directory.<br>";
            } else {
                echo "Error deleting the image file from the directory.<br>";
            }
        } else {
            echo "File does not exist in the directory.<br>";
        }

        // Now delete the database record
        $delete_query = "DELETE FROM programs_img WHERE img_id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, 'i', $img_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image record has been deleted successfully from the database.';
            add_user_log($_SESSION['user_id'], "Deleted program image with ID '" . $img_id . "'");
        } else {
            echo "Error deleting image record from the database: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "No image found with the provided ID.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($con);
?>
