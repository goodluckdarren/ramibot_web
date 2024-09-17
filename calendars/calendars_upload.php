<?php
require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['calendarIdentifier']) && isset($_POST['category'])) {
        $calendar_identifier = $_POST['calendarIdentifier'];
        $category = $_POST['category'];

        $uploadDir = 'calendars_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);
        $fileName = $_FILES['fileInput']['name'];

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO calendars_img (img_identifier, img_url, category) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $calendar_identifier, $imgUrl, $category);

            if ($stmt->execute()) {
                ?>
                <script>
                    alert("Record added successfully.");
                    window.history.back();
                </script>
                <?php
                add_user_log($_SESSION['user_id'], "Added calendar image '" . $fileName . "'");
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
            alert('Missing calendarIdentifier or category.');
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
