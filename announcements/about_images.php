<?php
require_once('../database_connect.php');

$sql = "SELECT rf.info_id, rf.img_url
        FROM apcinfo_img AS rf
        ORDER BY rf.info_id ASC";

$statement = mysqli_prepare($con, $sql);

if ($statement === false) {
    die("Prepare failed: " . mysqli_error($con));
}

mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $info_id, $img_url);

while (mysqli_stmt_fetch($statement)) {
    $img_url = '' . htmlspecialchars($img_url, ENT_QUOTES, 'UTF-8');
    echo '<div class="image-container">';
    echo '<img src="' . $img_url . '" class="image-size" alt="Image">';
    echo '<button class="delete-button" type="button" onclick="deleteImage(' . $info_id . ')"> 
                <i class="fas fa-trash large-trash-icon"></i></button>';
    echo '</div>';  
    
}

mysqli_stmt_close($statement);
mysqli_close($con);
?>
<script>
function deleteImage($info_Id) {
    if (confirm("Are you sure you want to delete this image?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "about_delete.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    // Reload the page or update the image container after successful deletion
                    // Example: window.location.reload();
                    window.location.reload();
                } else {
                    alert("Error deleting image: " + xhr.responseText);
                }
            }
        };
        xhr.send("info_id=" + $info_Id);
    }  
    location.reload();
}
</script>
