<?php

// Set the maximum upload file size FIND THE php.ini file and change the upload_max_filesize and post_max_size
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

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $uploadFileDir = '../programs_img/';
        $dest_path = $uploadFileDir . $newFileName;

        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "File is successfully uploaded.";
        } else {
            echo "There was some error moving the file to the upload directory. Please make sure the upload directory is writable by the web server.";
        }
    } else {
        echo "There was an error with the file upload. Error code: " . $_FILES['fileInput']['error'];
    }
} else {
    echo "No file uploaded.";
}
?>