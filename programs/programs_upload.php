<?php
require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

// Set the maximum upload file size
ini_set('upload_max_filesize', '40M');
ini_set('post_max_size', '40M');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['programsIdentifier'])) {
        $programs_identifier = $_POST['programsIdentifier'];

        // Directory where the file will be uploaded
        $uploadDir = '../RamiAPI/Images/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);
        $fileName = $_FILES['fileInput']['name'];

        // Check if the directory exists, if not, create it
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory with full access
        }

        // Attempt to move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            // Prepare and execute the query to insert image data into the database
            $stmt = $con->prepare("INSERT INTO programs_img (img_identifier, img_url) VALUES (?, ?)");
            $stmt->bind_param("ss", $programs_identifier, $imgUrl);

            if ($stmt->execute()) {
                echo "Record added successfully";
                echo '<br><button onclick="goBack()">Okay</button>';
                add_user_log($_SESSION['user_id'], "Added program image '" . $fileName . "'");
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $con->close();
        } else {
            echo 'Error uploading file to the directory.';
        }
    } else {
        echo 'Missing programsIdentifier.';
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
    