<?php
    require_once('../database_connect.php');

    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'img_identifier'; // Default sorting column
    $sql = "SELECT * FROM calendars_img ORDER BY $sort_by";
    $result_table = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result_table)) {
        $calendarIdentifier = $row['img_identifier'];
        $calendarImg = $row['img_url'];
        $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'); // Sanitize the category output

        echo "<div class='calendar-content'>";
        echo "<div class='calendar-text'>$calendarIdentifier</div>";
        echo "<div class='category-text'>$category</div>"; // Add category-text class for filtering
        echo "<img src='$calendarImg' alt='$calendarIdentifier'>";
        echo '<div class="action-button">';
        echo '<button style="width: 30px; height: 30px;" 
                class="delete-button" type="button" 
                onclick="deleteRow(' . $row['calendar_id'] . ')"> 
                <i class="fas fa-trash"></i></button>';
        echo '</div>';
        echo "</div>";
    }
?>

``
<script>    
     function deleteRow(calendar_id) {
        if (confirm("Do you want to delete this?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "calendars_delete.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert("Image has been successfully deleted.");
                        location.reload();
                    } else {
                        alert("Error deleting image: " + xhr.responseText);
                    }
                }
            };
            xhr.send("calendar_id=" + calendar_id);
        }
    }
</script>