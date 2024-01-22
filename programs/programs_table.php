<?php
    require_once('../database_connect.php');

    $sql = "SELECT rf.img_url
        FROM programs_img AS rf
        ORDER BY rf.img_id ASC";

    $statement = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $img_url);

    while (mysqli_stmt_fetch($statement)) {
        echo "<div><img class='image-size' src=", $img_url , " alt='Image'></div>";
    }
 
    mysqli_stmt_close($statement);
    mysqli_close($con);
?>