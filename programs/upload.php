<?php
require_once('../database_connect.php');

$uploadDir = '../programs_img/';
$uploadFile = $uploadDir . basename($_FILES['file']['name']);

$response = [];

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    $imageUrl = $uploadFile;

    // Insert the image URL into the database, img_id will be auto-incremented
    $insertQuery = "INSERT INTO programs_img (img_url) VALUES ('$imageUrl')";
    
    if ($mysqli->query($insertQuery)) {
        // Get the auto-incremented img_id
        $imgId = $mysqli->insert_id;

        $response = ['success' => true, 'imgId' => $imgId, 'imageUrl' => $imageUrl];
    } else {
        $response = ['success' => false, 'error' => 'Failed to insert into the database.'];
    }
} else {
    $response = ['success' => false, 'error' => 'Failed to upload file.'];
}

header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$mysqli->close();
?>
