<?php
require_once 'database_connect.php';  // Adjust the path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['programsIdentifier']) && isset($_FILES['fileInput'])) {
        $programsIdentifier = $_POST['programsIdentifier'];
        $uploadDir = 'Z:/programs_img/';
        $relativeDir = 'programs_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);
        $imgUrl = $relativeDir . basename($_FILES['fileInput']['name']);

        if (is_writable($uploadDir)) {
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
                $stmt = $con->prepare("INSERT INTO programs_img (img_identifier, img_url) VALUES (?, ?)");
                $stmt->bind_param("ss", $programsIdentifier, $imgUrl);

                if ($stmt->execute()) {
                    echo "Record added successfully";
                    echo '<br><button onclick="goBack()">Okay</button>';
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $con->close();
            } else {
                echo 'Error uploading file.';
            }
        } else {
            echo 'Upload directory is not writable.';
            echo '<br>Check the permissions of the directory: ' . $uploadDir;
        }
    } else {
        echo 'Missing programsIdentifier or file.';
    }
} else {
    echo 'Invalid request.';
}
?>
<script>
function goBack() {
    window.history.back();
}
</script>
