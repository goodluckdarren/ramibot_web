<?php
    require_once('../database_connect.php');

    // Query to join admin_accounts and role_types tables
    $sql = "SELECT ac.user_id, ac.email, ac.username, 
                   rt.role_name, ac.user_status
            FROM admin_accounts ac
            JOIN role_type rt ON ac.role = rt.role_id";

    $result = mysqli_query($con, $sql);

    if ($result === false){
        die("Failed to connect with MySQL: " . mysqli_error($con));
    }

    echo '<table class="user-management-table">';
    echo '<tr>';
    echo '<th>User ID</th>';
    echo '<th>Email Address</th>';
    echo '<th>Username</th>';
    echo '<th>Role</th>';
    echo '<th>User Status</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    // Loop through the results and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Conditional check to highlight the row if the user_id matches the current session user_id
        // $highlightClass = ($row['user_id'] == $_SESSION['user_id']) ? 'highlight-row' : '';
        // $disabledClass = ($row['user_status'] == 0) ? 'disabled' : '';
        // echo '<tr class="' . $disabledClass . ' ' . $highlightClass . '">';

        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['role_name'] . '</td>';
        
        // Conditional check to display "Active" or "Disabled" based on user_status value
        echo '<td>';
        echo '<form class="status-form">';
        echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
        echo '<select name="user_status" onchange="updateStatus(this.form);"';
        if ($row['user_id'] == $_SESSION['user_id']) {
            echo ' disabled';
        }
        echo '>';
        echo '<option class="status-enabled" value="1"' . ($row['user_status'] == 1 ? ' selected' : '') . '>Enabled</option>';
        echo '<option class="status-disabled" value="0"' . ($row['user_status'] == 0 ? ' selected' : '') . '>Disabled</option>';
        echo '</select>';
        echo '</form>';
        echo '</td>';
        
        echo '<td class="action-buttons">';
        echo '<div>';
        echo '<button class="edit-button" type="button" onclick="editRow(' . $row['user_id'] . ')"> 
                        <i class="fas fa-edit"></i></button>';
        echo '<button class="delete-button" type="button" onclick="deleteRow(' . $row['user_id'] . ')"> 
                        <i class="fas fa-trash"></i></button>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
?>