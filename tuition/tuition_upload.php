<?php

require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tuitionIdentifier'])) {
        $tuitionIdentifier = $_POST['tuitionIdentifier'];

        $uploadDir = '../RamiAPI/Images/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];
            $fileName = $_FILES['fileInput']['name'];

            $stmt = mysqli_prepare($con, "INSERT INTO tuition_img (img_identifier, img_url) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $tuitionIdentifier, $imgUrl);

            if (mysqli_stmt_execute($stmt)) {
                add_user_log($_SESSION['user_id'], "Added tuition image '" . $fileName . "'");
                echo '<script>alert("Record added successfully."); window.history.back();</script>';
            } else {
                echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '"); window.history.back();</script>';
            }

            mysqli_stmt_close($stmt);
            mysqli_close($con);
        } else {
            echo '<script>alert("Error uploading file."); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Missing tuitionIdentifier."); window.history.back();</script>';
    }
} else {
    echo '<script>alert("Invalid request."); window.history.back();</script>';
}

?>
