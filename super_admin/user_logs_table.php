<?php
    require_once('../database_connect.php');

    echo '<h2>User Activity Logs</h2>';
    
    // Query to get the logs
    $sql_logs = "SELECT ul.*, ac.username 
                 FROM user_logs ul 
                 JOIN admin_accounts ac ON ul.user_id = ac.user_id
                 ORDER BY ul.timestamp DESC 
                 LIMIT 10";  // Adjust the limit as needed

    $logs_result = mysqli_query($con, $sql_logs);

    if ($logs_result === false) {
        die("Failed to connect with MySQL: " . mysqli_error($con));
    }

    echo '<table class="logs-table">';
    echo '<tr>';
    echo '<th>User</th>';
    echo '<th>Action</th>';
    echo '<th>Timestamp</th>';
    echo '</tr>';

    // Loop through the results and display each log
    while ($log = mysqli_fetch_assoc($logs_result)) {
        echo '<tr>';
        echo '<td>' . $log['username'] . '</td>';
        echo '<td>' . $log['action'] . '</td>';
        echo '<td>' . $log['timestamp'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
?>
