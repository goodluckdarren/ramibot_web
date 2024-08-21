<?php

require_once ('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['programsIdentifier'])) {
        
        $targetDirectory = '../programs_img/';
        $uploadFile = basename($_FILES['fileInput']['name']);
        $targetFilePath = $targetDirectory . $uploadFile;

        if (empty($uploadFile)) {
            echo 'No file selected.';
            exit();
        }

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $targetFilePath)) {
            echo 'File uploaded successfully.';
        } else {
            echo 'There was an error uploading the file.';
        }
    } else {
        echo 'Missing programsIdentifier.';
        exit();
    }
}
?>

