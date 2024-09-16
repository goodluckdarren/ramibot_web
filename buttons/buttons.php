<?php require_once('../verify_login.php')?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/interactions.css">
    <link rel="stylesheet" href="../styles/buttons.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/redirect.js"></script>
</head>
<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <?php include_once '../scripts/side_panel.php'; ?>
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">BUTTON LISTS</p>
                </div>
                <div class="user-profile">
                    <?php include_once '../admin_account.php'; ?>
                    <a href="../logout.php" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class="buttons-table-container">
                        <div class="edit-button-form">
                            <form method="POST" id="categoryForm" action="">
                            <div class="form-header">
                                <div class="category-selector">
                                    <label for="category">Select Category:</label>
                                    <select name="category" id="category" required>
                                        <option value="">-- Select Category --</option>
                                        <?php
                                        // List of categories
                                        $columns = ['Main_Menu', 'Office_Schedule', 'Faculty_Schedule', 'SOE_Faculty', 'SOAR_Faculty', 'SOCIT_Faculty', 'SOM_Faculty', 'SOMA_Faculty', 'SHS_Faculty', 'GS_Faculty', 'Programs_Offered', 'School_Information', 'Other_Information', 'Accreditations_and_Certifications', 'Tuition_Fees', 'School_Calendar', 'School_Organizations', 'Floor_Maps'];
                                        
                                        foreach ($columns as $column) {
                                            echo "<option value='$column'>$column</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="button-group">
                                    <button type="button" id="add-entry-button">Add Button</button>
                                </div>
                            </div>
                            <h3>Entries</h3>
                            <div id="entries-list">
                            </div>
                            <div id="new-entry-section" style="display: none;">
                                <h4>Add New Entry</h4>
                                <div>
                                    <label for="new-column">Select Column:</label>
                                    <select name="new-column" id="new-column" required>
                                        <option value="">-- Select Column --</option>
                                        <?php
                                        // Repeat the same list of categories
                                        foreach ($columns as $column) {
                                            echo "<option value='$column'>$column</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <input type="text" id="new-entry" placeholder="Enter new entry value" required>
                                    <button type="button" id="submit-new-entry">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
        $(document).ready(function() {
    $('#category').change(function() {
        var category = $(this).val();
        if (category) {
            $.ajax({
                type: 'POST',
                url: 'fetch_entries.php',
                data: { category: category },
                success: function(response) {
                    $('#entries-list').html(response);
                },
                error: function(xhr, status, error) {
                    $('#entries-list').html('<p>Error loading data.</p>');
                }
            });
        } else {
            $('#entries-list').html('');
        }
    });

    $(document).on('click', '.delete-btn', function() {
        var column = $(this).data('column');
        var value = $(this).data('value');

        if (confirm('Are you sure you want to delete this entry?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_entry.php',
                data: { column: column, value: value },
                success: function(response) {
                    alert(response); // Handle response                        
                    $('#category').trigger('change'); // Refresh the entries list
                },
                error: function(xhr, status, error) {
                    alert('Error deleting entry.');
                }
            });
        }
    });

    // Show the new entry section when Add Entry is clicked
    $('#add-entry-button').click(function() {
        $('#new-entry-section').toggle(); // Toggle visibility of the new entry section
    });

    // Handle new entry submission
    $('#submit-new-entry').click(function() {
        var newColumn = $('#new-column').val();
        var newEntry = $('#new-entry').val();

        if (newColumn && newEntry) {
            $.ajax({
                type: 'POST',
                url: 'add_entry.php',
                data: { column: newColumn, value: newEntry },
                success: function(response) {
                    alert(response); // Handle response
                    $('#new-entry').val(''); // Clear the input
                    $('#new-column').val(''); // Reset the dropdown
                    $('#category').trigger('change'); // Refresh the entries list
                },
                error: function(xhr, status, error) {
                    alert('Error adding entry.');
                }
            });
        } else {
            alert('Please select a column and enter a value.');
        }
    });
});

</script>
    