<?php
require_once('../database_connect.php');

// Number of records per page
$rows_per_page = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

// Query to get total number of records for pagination
$sql_total = "SELECT COUNT(*) as total FROM admin_accounts";
$total_result = mysqli_query($con, $sql_total);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_records / $rows_per_page);

// Query to fetch the data with pagination
$sql = "SELECT ac.user_id, ac.email, ac.username, 
                   rt.role_name, ac.user_status
            FROM admin_accounts ac
            JOIN role_type rt ON ac.role = rt.role_id
            LIMIT $offset, $rows_per_page";

$result = mysqli_query($con, $sql);

if ($result === false) {
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
    $highlightClass = ($row['user_id'] == $_SESSION['user_id']) ? 'highlight-row' : '';
    $disabledClass = ($row['user_status'] == 0) ? 'disabled' : '';
    echo '<tr class="' . $disabledClass . ' ' . $highlightClass . '">';
    echo '<td>' . $row['user_id'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>' . $row['role_name'] . '</td>';
    echo '<td>' . ($row['user_status'] == 1 ? 'Enabled' : 'Disabled') . '</td>';
    echo '<td class="action-buttons">';
    echo '<button class="edit-button" type="button" onclick="editRow(' . $row['user_id'] . ')"> 
                        <i class="fas fa-edit"></i></button>';
    echo '<button class="delete-button" type="button" onclick="deleteRow(' . $row['user_id'] . ')"> 
                        <i class="fas fa-trash"></i></button>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';

// Display pagination
echo '<ul id="users-pagination" class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
    echo '<a class="page-link" href="#" onclick="loadPage(' . $i . ')">' . $i . '</a>';
    echo '</li>';
}
echo '</ul>';
?>

<script>
    var currentUserPage = <?php echo $page; ?>; // Current page for users table
    var totalUserPages = <?php echo $total_pages; ?>; // Total pages for users table

    $(document).ready(function() {
        updateUserPagination();
    });

    function loadUserPage(page) {
        if (page < 1 || page > totalUserPages || page === currentUserPage) {
            return;
        }

        currentUserPage = page;

        $.ajax({
            url: 'users_table.php',
            type: 'GET',
            data: {
                page: currentUserPage
            },
            success: function(data) {
                console.log('Users Table Data:', data);
                $('#user-management-table-content').fadeOut('fast', function() {
                    $(this).html(data).fadeIn('fast');
                });
                updateUserPagination(); // Update pagination for users table

            },
            error: function() {
                alert('Error loading user table content.');
            }
        });
    }

    function updateUserPagination() {
        var paginationHtml = '';
        var maxButtons = 5;

        var startPage = Math.max(1, currentUserPage - Math.floor(maxButtons / 2));
        var endPage = Math.min(totalUserPages, startPage + maxButtons - 1);

        if (endPage - startPage < maxButtons - 1) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        paginationHtml += '<li class="page-item ' + (currentUserPage === 1 ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadUserPage(' + (currentUserPage - 1) + ')">&laquo;</a>';
        paginationHtml += '</li>';

        for (var i = startPage; i <= endPage; i++) {
            paginationHtml += '<li class="page-item ' + (i === currentUserPage ? 'active' : '') + '">';
            paginationHtml += '<a class="page-link" href="#" onclick="loadUserPage(' + i + ')">' + i + '</a>';
            paginationHtml += '</li>';
        }

        paginationHtml += '<li class="page-item ' + (currentUserPage === totalUserPages ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadUserPage(' + (currentUserPage + 1) + ')">&raquo;</a>';
        paginationHtml += '</li>';

        $('#users-pagination').html(paginationHtml);
    }
</script>




<script>
    function updateStatus(form) {
        var formData = $(form).serialize();
        $.ajax({
            url: 'update_user_status.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                alert(data);
            },
            error: function() {
                alert('Error updating user status.');
            }
        });
    }

    function editRow(userId) {
        var currentUserId = <?php echo $_SESSION['user_id']; ?>;

        if (userId === currentUserId) {
            alert('You cannot edit your own account.');
            return;
        } else {
            if (confirm('Are you sure you want to edit this user?')) {
                window.location.href = 'user_edit_page.php?user_id=' + userId;
            }
        }
    }

    function deleteRow(userId) {
        var currentUserId = <?php echo $_SESSION['user_id']; ?>;

        if (userId === currentUserId) {
            alert('You cannot delete your own account.');
            return;
        } else {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        // Assuming response contains success or error message
                        if (response.includes('successfully')) {
                            alert('User deleted successfully.');
                        } else {
                            alert('Failed to delete user.');
                        }
                        loadTableContent(currentPage);
                    },
                    error: function() {
                        alert('Error deleting user.');
                    }
                });
            }
        }
    }
</script>