<?php
    require_once('../database_connect.php');

    $rows_per_page = 1;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $offset = ($page - 1) * $rows_per_page;

    // Use prepared statements to prevent SQL injection
    $count_query = "SELECT COUNT(*) as count FROM programs_img";
    $count_statement = mysqli_prepare($con, $count_query);
    mysqli_stmt_execute($count_statement);
    mysqli_stmt_bind_result($count_statement, $total_rows);
    mysqli_stmt_fetch($count_statement);
    mysqli_stmt_close($count_statement);

    $total_pages = ceil($total_rows / $rows_per_page);

    $sql = "SELECT rf.img_url
        FROM programs_img AS rf
        ORDER BY rf.img_id ASC
        LIMIT ?, ?";
    $statement = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($statement, "ii", $offset, $rows_per_page);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $img_url);

    while (mysqli_stmt_fetch($statement)) {
        echo "<tr>";
        echo "<td><img src=", $img_url , " alt='Image' width = '400' height='400'></td>";
        echo "</tr>";
    }
    

    mysqli_stmt_close($statement);
    mysqli_close($con);
?>
