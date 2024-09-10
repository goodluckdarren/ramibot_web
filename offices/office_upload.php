<?php

require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['officeIdentifier'])) {
        $office_identifier = $_POST['officeIdentifier'];

        $uploadDir = '../offices_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO offices (img_identifier, img_url) VALUES (?, ?)");
            $stmt->bind_param("ss", $office_identifier, $imgUrl);

            if ($stmt->execute()) {
                echo "Record added successfully";
                echo '<br><button onclick="goBack()">Okay</button>';
                add_user_log($_SESSION['user_id'], "Added office image");
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $con->close();
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Missing floorId or floorIdentifier.';
    }
    ?>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <?php
} else {
    echo 'Invalid request.';
}
?>
