<?php
require_once('../database_connect.php');

$sql = "SELECT rf.img_url
        FROM programs_img AS rf
        ORDER BY rf.img_id ASC";

$statement = mysqli_prepare($con, $sql);

if ($statement === false) {
    die("Prepare failed: " . mysqli_error($con));
}

mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $img_url);

while (mysqli_stmt_fetch($statement)) {
    $img_url = '../programs_img/' . htmlspecialchars($img_url, ENT_QUOTES, 'UTF-8');
    echo "<div><img class='image-size' alt='Image' src='", $img_url, "'></div>";
}

mysqli_stmt_close($statement);
mysqli_close($con);
?>
