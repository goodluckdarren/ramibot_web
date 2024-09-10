<?php
require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['calendarIdentifier']) && isset($_POST['category'])) {
        $calendar_identifier = $_POST['calendarIdentifier'];
        $category = $_POST['category'];

        $uploadDir = '../calendars_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO calendars_img (img_identifier, img_url, category) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $calendar_identifier, $imgUrl, $category);

            if ($stmt->execute()) {
                echo "Record added successfully";
                echo '<br><button onclick="goBack()">Okay</button>';
                add_user_log($_SESSION['user_id'], "Added calendar image");
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $con->close();
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Missing calendarIdentifier or category.';
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
