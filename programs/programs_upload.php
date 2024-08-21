<?php

require_once ('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['programsIdentifier'])) {
        
        // Directory where the files will be uploaded
        $targetDirectory = 'programs_img/';
        
        // Get the original file name
        $uploadFile = basename($_FILES['fileInput']['name']);
        
        // Set the target file path
        $targetFilePath = $targetDirectory . $uploadFile;

        // Check if a file was selected
        if (empty($uploadFile)) {
            echo 'No file selected.';
            exit();
        }

        // Check if file upload is successful
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $targetFilePath)) {
            echo 'File uploaded successfully.';
            // Here you can also save the file path and programsIdentifier to the database if needed
        } else {
            echo 'There was an error uploading the file.';
        }
    } else {
        echo 'Missing programsIdentifier.';
        exit();
    }
}
?>
