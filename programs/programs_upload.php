<?php

require_once '../database_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../programs_img/'; // Specify your desired folder location
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        // Move the uploaded file to the specified folder
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            echo 'File has been uploaded successfully.<br>';
            
            // Display the uploaded picture
            echo '<img src="' . $uploadFile . '" alt="Uploaded Picture" style="max-width: 100%;">';

            // Insert into the database
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $sql = "INSERT INTO programs_img (img_url) VALUES ('$imgUrl')";
            if ($con->query($sql) === TRUE) {
                echo "Record inserted into the database successfully.";
            } else {
                // Check for duplicate entry error (1062) and handle accordingly
                if ($con->errno == 1062) {
                    echo "Error: Duplicate entry. Handle this case as needed.";
                } else {
                    echo "Error inserting record into the database: " . $con->error;
                }
            }

            // Close the database connection
            $con->close();
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'No file uploaded or an error occurred.';
    }
    ?>
    <!-- Display an "Okay" button to go back -->
    <br>
    <button onclick="goBack()">Okay</button>

    <script>
        // JavaScript function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>

    <?php
} else {
    echo 'Invalid request.';
}
?>
