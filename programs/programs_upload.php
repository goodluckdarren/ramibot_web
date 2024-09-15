<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

// Set the maximum upload file size
ini_set('upload_max_filesize', '40M');
ini_set('post_max_size', '40M');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fileInput']['tmp_name'];
        $fileName = $_FILES['fileInput']['name'];
        $fileSize = $_FILES['fileInput']['size'];
        $fileType = $_FILES['fileInput']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = $fileName;

        // Get the programs identifier from the form input
        $programsIdentifier = mysqli_real_escape_string($con, $_POST['programsIdentifier']);

        $uploadFileDir = 'programs_img/';
        $dest_path = $uploadFileDir . $newFileName;

        // Create directory if it doesn't exist
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Insert file info into the database
            $insertQuery = "INSERT INTO programs_img (img_url, img_identifier) VALUES (?, ?)";
            $stmt = mysqli_prepare($con, $insertQuery);

            if ($stmt === false) {
                die('Error preparing statement: ' . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, 'ss', $newFileName, $programsIdentifier);

            if (mysqli_stmt_execute($stmt)) {
                echo "File successfully uploaded and added to the database.";
                echo '<br><button onclick="goBack()">Okay</button>';
                add_user_log($_SESSION['user_id'], "Added program image for '" . $fileName . "'");
            } else {
                echo "Error inserting image into the database: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error moving the file to the upload directory.";
        }
    } else {
        echo "File upload error. Error code: " . $_FILES['fileInput']['error'];
    }
} else {
    echo "No file uploaded.";
}

mysqli_close($con);
?>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
