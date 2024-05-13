<?php
    require_once('../database_connect.php');

    $rows_per_page = 10;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $offset = ($page - 1) * $rows_per_page;

    
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_number'; 
        
    
    // Construct the ORDER BY clause for sorting
    $sort_clause = "ORDER BY $sort ASC";
    
    $search_condition = '';
    if (!empty($search)) {
        $search_condition = "WHERE ID_Number LIKE '%$search%' OR 
                            Profession LIKE '%$search%' OR 
                            Last_Name LIKE '%$search%' OR 
                            Given_Name LIKE '%$search%' OR 
                            MI LIKE '%$search%' OR 
                            nickname LIKE '%$search%'";
    }

    $sort_clause = "ORDER BY $sort ASC";

    $count_query = "SELECT COUNT(*) as count FROM ramibot_faces $search_condition";
    $count_result = mysqli_query($con, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_rows = $count_row['count'];

    $total_pages = ceil($total_rows / $rows_per_page);

    $sql = "SELECT rf.* 
        FROM ramibot_faces AS rf
        $search_condition
        $sort_clause
        LIMIT $offset, $rows_per_page";
    $result_table = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result_table)) {
        echo "<tr>";
        echo "<td>" . $row['ID_Number'] . "</td>";
        echo "<td>" . $row['Profession'] . "</td>";
        echo "<td>" . $row['Last_Name'] . "</td>";
        echo "<td>" . $row['Given_Name'] . "</td>";
        echo "<td>" . $row['MI'] . "</td>";
        echo "<td>" . $row['nickname'] . "</td>";
        echo '<td class="action-buttons">';
        echo '<div>';
        echo '<button class="delete-button" type="button" onclick="deleteRow(' . $row['ID_Number'] . ')"> 
                <i class="fas fa-trash"></i></button>';
        echo '</div>';
        echo '</td>';
        echo "</tr>";
    }
?>

<script>
    var currentPage = <?php echo $page; ?>;
    var totalPages = <?php echo $total_pages; ?>;

    $(document).ready(function () {
        updatePagination();
    });

    function updatePagination() {
        var paginationHtml = '';
        var maxButtons = 5;

        var startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        var endPage = Math.min(totalPages, startPage + maxButtons - 1);

        if (endPage - startPage < maxButtons - 1) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        // Previous button
        paginationHtml += '<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') + '"><a class="page-link" href="#" onclick="loadPage(' + (currentPage - 1) + ')">&laquo;</a></li>';

        for (var i = startPage; i <= endPage; i++) {
            paginationHtml += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" onclick="loadPage(' + i + ')">' + i + '</a></li>';
        }

        // Next button
        paginationHtml += '<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') + '"><a class="page-link" href="#" onclick="loadPage(' + (currentPage + 1) + ')">&raquo;</a></li>';

        $('#pagination').html(paginationHtml);
    }

    
    function loadPage(page) {
    if (page < 1 || page > totalPages || page === currentPage) {
        return;
    }

    currentPage = page;
    updatePagination();
    loadTableContent();

    event.preventDefault();
    }

    function loadTableContent(search, sort) {
    $.ajax({
        url: '../userfiles/user_files_table.php',
        type: 'GET',
        data: { 
            page: currentPage,
            search: search,
            sort: sort
        },
        success: function (data) {
            $('#user-files-table-content').fadeOut('fast', function () {
                $(this).html(data).fadeIn('fast');
            });
        },
        error: function () {
            alert('Error loading table content.');
        }
    });
}

</script>
<script>

     function deleteRow(ID_Number) {
        if (confirm("Do you want to delete this user?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../userfiles/delete_user.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert("User has been successfully deleted.");
                        location.reload();
                    } else {
                        alert("Error deleting user: " + xhr.responseText);
                    }
                }
            };
            xhr.send("ID_Number=" + ID_Number);
        }
    }
</script>
<script>
function searchAndLoad() {
    var searchInput = document.getElementById('search-input').value;
    var sortSelect = document.getElementById('sort-select').value;
    currentPage = 1;
    updatePagination();
    loadTableContent(searchInput, sortSelect);
}
</script>