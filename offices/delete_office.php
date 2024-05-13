<?php
require_once('../database_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['office_id'])) {
    $office_id = $_POST['office_id'];

    $delete_query = "DELETE FROM offices WHERE office_id = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, 'i', $img_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo 'Image has been deleted successfully.';
    } else {
        echo "Error deleting image: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}
?>
