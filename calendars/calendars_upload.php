<?php
require_once '../database_connect.php';

// Debug: Check if script execution reaches this point
echo "Debug: Script started.<br>";

// Initialize $category variable
$category = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['calendarIdentifier'])) {
        $calendar_identifier = $_POST['calendarIdentifier'];

        // Extracting category from calendarIdentifier
        $category = explode(' ', $calendar_identifier)[0];

        // Debug: Check the extracted category value
        echo "Debug: Extracted category: $category<br>";

        $uploadDir = '../calendars_img/';
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            $imgUrl = $uploadDir . $_FILES['fileInput']['name'];

            $stmt = $con->prepare("INSERT INTO calendars_img (calendar_identifier, img_url, category) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $calendar_identifier, $imgUrl, $category);
            
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
        echo 'Missing calendarIdentifier.';
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
