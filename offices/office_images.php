<?php
    require_once('../database_connect.php');

    $sql = "SELECT of.* 
    FROM offices AS of";
    $result_table = mysqli_query($con, $sql);

    

    while ($row = mysqli_fetch_assoc($result_table)) {
        $office_identifier = $row['img_identifier'];
        $office_img = $row['img_url'];

        echo "<div class='office-content'>
        <div class='office-text'>$office_identifier</div>
        <img src='$office_img'>";
        echo '<div class="action-button">';
        echo '<button style="width: 30px; height: 30px;" 
                class="delete-button" type="button" 
                onclick="deleteRow(' . $row['office_id'] . ')"> 
                <i class="fas fa-trash"></i></button>';
        echo '</div>';

    }
?>


<script>    
     function deleteRow(office_id) {
        if (confirm("Do you want to delete this?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../offices/delete_office.php", true);
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
            xhr.send("office_id=" + office_id);
        }
    }
</script>