<?php
require_once('../database_connect.php');

$sql = "SELECT rf.img_id, rf.img_url
        FROM programs_img AS rf
        ORDER BY rf.img_id ASC";

$statement = mysqli_prepare($con, $sql);

if ($statement === false) {
    die("Prepare failed: " . mysqli_error($con));
}

mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $img_id, $img_url);

while (mysqli_stmt_fetch($statement)) {

    echo '<div class="image-container">';
    echo '<img src="' . $img_url . '" class="image-size" alt="Image">';
    echo '<button class="delete-button" type="button" onclick="deleteImage(' . $img_id . ')"> 
                <i class="fas fa-trash large-trash-icon"></i></button>';
    echo '</div>';  
    
}

mysqli_stmt_close($statement);
mysqli_close($con);
?>
<script>
function deleteImage($img_Id) {
    if (confirm("Are you sure you want to delete this image?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "programs_delete.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    // Reload the page or update the image container after successful deletion
                    window.location.reload();
                } else {
                    alert("Error deleting image: " + xhr.responseText);
                }
            }
        };
        xhr.send("img_id=" + $img_Id);
    }  
    location.reload();
}
</script>
