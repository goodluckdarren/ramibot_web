<?php
require_once('../database_connect.php');

$rows_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

$sql_total_logs = "SELECT COUNT(*) as total_logs FROM user_logs";
$total_logs_result = mysqli_query($con, $sql_total_logs);
$total_logs_row = mysqli_fetch_assoc($total_logs_result);
$total_logs = $total_logs_row['total_logs'];

$total_pages = ceil($total_logs / $rows_per_page);

$sql_logs = "SELECT ul.*, ac.username 
             FROM user_logs ul 
             JOIN admin_accounts ac ON ul.user_id = ac.user_id
             ORDER BY ul.timestamp DESC 
             LIMIT $offset, $rows_per_page";
$logs_result = mysqli_query($con, $sql_logs);

if ($logs_result === false) {
    die("Failed to connect with MySQL: " . mysqli_error($con));
}

while ($log = mysqli_fetch_assoc($logs_result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($log['username']) . '</td>';
    echo '<td>' . htmlspecialchars($log['action']) . '</td>';
    echo '<td>' . htmlspecialchars($log['timestamp']) . '</td>';
    echo '</tr>';
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var currentLogPage = <?php echo $page; ?>; // Current page for user logs table
    var totalLogPages = <?php echo $total_pages; ?>; // Total pages for user logs table

    $(document).ready(function() {
        updateLogPagination();
    });

    function loadLogPage(page) {
        if (page < 1 || page > totalLogPages || page === currentLogPage) {
            return;
        }

        currentLogPage = page;

        $.ajax({
            url: 'user_logs_table.php',
            type: 'GET',
            data: {
                page: currentLogPage
            },
            success: function(data) {
                $('#user-logs-table-content').fadeOut('fast', function() {
                    $(this).html(data).fadeIn('fast');
                });
                updateLogPagination(); // Update pagination for logs table
            },
            error: function() {
                alert('Error loading user logs table content.');
            }
        });
    }

    function updateLogPagination() {
        var paginationHtml = '';
        var maxButtons = 5;

        var startPage = Math.max(1, currentLogPage - Math.floor(maxButtons / 2));
        var endPage = Math.min(totalLogPages, startPage + maxButtons - 1);

        if (endPage - startPage < maxButtons - 1) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        paginationHtml += '<li class="page-item ' + (currentLogPage === 1 ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadLogPage(' + (currentLogPage - 1) + ')">&laquo;</a>';
        paginationHtml += '</li>';

        for (var i = startPage; i <= endPage; i++) {
            paginationHtml += '<li class="page-item ' + (i === currentLogPage ? 'active' : '') + '">';
            paginationHtml += '<a class="page-link" href="#" onclick="loadLogPage(' + i + ')">' + i + '</a>';
            paginationHtml += '</li>';
        }

        paginationHtml += '<li class="page-item ' + (currentLogPage === totalLogPages ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadLogPage(' + (currentLogPage + 1) + ')">&raquo;</a>';
        paginationHtml += '</li>';

        $('#logs-pagination').html(paginationHtml);
    }
</script>

