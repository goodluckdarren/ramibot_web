<?php require_once '../database_connect.php'; ?>


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
        });
    </script>
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
                                        <button type="button" id="add-entry-button">Add Entry</button>
                                        <button type="submit">Save</button>
                                    </div>
                                </div>

                                <h3>Entries</h3>
                                <div id="entries-list">
                                    <!-- Entries will be dynamically loaded here by AJAX -->
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

