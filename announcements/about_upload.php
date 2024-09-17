<?php

require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aboutIdentifier'])) {
        $aboutIdentifier = $_POST['aboutIdentifier'];

        $uploadDir = '../RamiAPI/Images/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);
        $fileName = $_FILES['fileInput']['name'];

        // Debugging logs
        echo '<script>console.log("Upload Directory: ' . $uploadDir . '");</script>';
        echo '<script>console.log("Upload File Path: ' . $uploadFile . '");</script>';

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO apcinfo_img (img_identifier, img_url) VALUES (?, ?)");
            $stmt->bind_param("ss", $aboutIdentifier, $imgUrl);

            if ($stmt->execute()) {
                ?>
                <script>
                    alert("Record added successfully.");
                    window.history.back();
                </script>
                <?php
                add_user_log($_SESSION['user_id'], "Added about APC image '" . $fileName . "'");
            } else {
                ?>
                <script>
                    alert("Error: <?php echo $stmt->error; ?>");
                </script>
                <?php
            }

            $stmt->close();
            $con->close();
        } else {
            ?>
            <script>
                alert('Error uploading file.');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Missing aboutIdentifier.');
        </script>
        <?php
    }
} else {
    ?>
    <script>
        alert('Invalid request.');
    </script>
    <?php
}
?>
