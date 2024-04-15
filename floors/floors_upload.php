    <?php

require_once '../database_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['floorId']) && isset($_POST['floorIdentifier'])) {
        $floor_id = $_POST['floorId'];
        $floor_identifier = $_POST['floorIdentifier'];

        $uploadDir = '../floors_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO floor_map (floor_id, floor_identifier, img_url) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $floor_id, $floor_identifier, $imgUrl);

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
        echo 'Missing floorId or floorIdentifier.';
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
