<?php

require_once '../database_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['school']) && isset($_POST['faculty_name']) && isset($_FILES['fileInput'])) {
        $school = $_POST['school'];
        $faculty_name = $_POST['faculty_name'];
        $uploadDir = 'facultysched_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        // Check if faculty_name already exists in the database
        $stmt = $con->prepare("SELECT img_url FROM faculty_scheds WHERE faculty_name = ?");
        $stmt->bind_param("s", $faculty_name);
        $stmt->execute();
        $stmt->store_result();

        // If record already exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($existingImgUrl);
            $stmt->fetch();
            $stmt->close();

            // Perform the file upload and update the record
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
                $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

                // Update the existing record
                $stmt = $con->prepare("UPDATE faculty_scheds SET school = ?, img_url = ? WHERE faculty_name = ?");
                $stmt->bind_param("sss", $school, $imgUrl, $faculty_name);

                if ($stmt->execute()) {
                    echo "Record updated successfully.";
                    echo '<br><button onclick="goBack()">Okay</button>';
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo 'Error uploading file.';
            }
        } else {
            // Proceed with insertion as the record does not exist
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
                $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

                $stmt = $con->prepare("INSERT INTO faculty_scheds (faculty_name, school, img_url) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $faculty_name, $school, $imgUrl);

                if ($stmt->execute()) {
                    echo "Record added successfully.";
                    echo '<br><button onclick="goBack()">Okay</button>';
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo 'Error uploading file.';
            }
        }
        $con->close();
    } else {
        echo 'Missing school, faculty_name, or file input.';
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