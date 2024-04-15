<?php
    require_once('../database_connect.php');

    $sql = "SELECT fm.* 
    FROM floor_map AS fm";
    $result_table = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result_table)) {
        $floor_identifier = $row['floor_identifier'];
        $floor_img = $row['img_url'];

        echo "<div class='floor-content'>
        <div class='floor-text'>$floor_identifier</div>
        <img src='$floor_img'>";
        echo '<div class="action-button">';
        echo '<button style="width: 30px; height: 30px;" 
                class="delete-button" type="button" 
                onclick="deleteRow(' . $row['floor_id'] . ')"> 
                <i class="fas fa-trash"></i></button>';
        echo '</div>';

    }
?>

<script>    
     function deleteRow(floor_id) {
        if (confirm("Do you want to delete this?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../floors/delete_floor.php", true);
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
            xhr.send("floor_id=" + floor_id);
        }
    }
</script>