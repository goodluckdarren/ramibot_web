<?php

require_once '../database_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../programs_img/'; 
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            echo 'File has been uploaded successfully.<br>';
            
            echo '<img src="' . $uploadFile . '" alt="Uploaded Picture" style="max-width: 100%;">';

            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $sql = "INSERT INTO floors_img (img_url) VALUES ('$imgUrl')";
            if ($con->query($sql) === TRUE) {
                echo "Record inserted into the database successfully.";
            } else {
                if ($con->errno == 1062) {
                    echo "Error: Duplicate entry. Handle this case as needed.";
                } else {
                    echo "Error inserting record into the database: " . $con->error;
                }
            }

            $con->close();
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'No file uploaded or an error occurred.';
    }
    ?>
    <br>
    <button onclick="goBack()">Okay</button>

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
