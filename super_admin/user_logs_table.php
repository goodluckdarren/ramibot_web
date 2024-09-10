<?php
require_once('../database_connect.php');

// Number of logs per page
$rows_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

// Query to get total number of logs for pagination
$sql_total_logs = "SELECT COUNT(*) as total_logs FROM user_logs";
$total_logs_result = mysqli_query($con, $sql_total_logs);
$total_logs_row = mysqli_fetch_assoc($total_logs_result);
$total_logs = $total_logs_row['total_logs'];

// Calculate total pages
$total_pages = ceil($total_logs / $rows_per_page);

// Query to get the logs with pagination
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
    var currentPage = <?php echo $page; ?>;
    var totalPages = <?php echo $total_pages; ?>; // Ensure this is correctly set

    $(document).ready(function() {
        updatePagination(); // Ensure pagination is updated on document ready
    });

    function updatePagination() {
        var paginationHtml = '';
        var maxButtons = 5; // Show max 5 buttons

        var startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        var endPage = Math.min(totalPages, startPage + maxButtons - 1);

        // Adjust startPage to always display maxButtons
        if (endPage - startPage < maxButtons - 1) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        // Previous button
        paginationHtml += '<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadPage(' + (currentPage - 1) + ')">&laquo;</a>';
        paginationHtml += '</li>';

        // Page buttons
        for (var i = startPage; i <= endPage; i++) {
            paginationHtml += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '">';
            paginationHtml += '<a class="page-link" href="#" onclick="loadPage(' + i + ')">' + i + '</a>';
            paginationHtml += '</li>';
        }

        // Next button
        paginationHtml += '<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') + '">';
        paginationHtml += '<a class="page-link" href="#" onclick="loadPage(' + (currentPage + 1) + ')">&raquo;</a>';
        paginationHtml += '</li>';

        // Insert the pagination HTML into the #logs-pagination element
        $('#logs-pagination').html(paginationHtml);
    }

    function loadPage(page) {
        if (page < 1 || page > totalPages || page === currentPage) {
            return;
        }

        currentPage = page;
        updatePagination();
        loadTableContent(page);

        event.preventDefault();
    }

    function loadTableContent(page) {
        $.ajax({
            url: 'user_logs_table.php',
            type: 'GET',
            data: {
                page: currentPage
            },
            success: function(data) {
                $('#user-logs-table-content').fadeOut('fast', function() {
                    $(this).html(data).fadeIn('fast');
                });
            },
            error: function() {
                alert('Error loading table content.');
            }
        });
    }
</script>