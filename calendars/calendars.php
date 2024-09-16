<?php require_once('../verify_login.php')?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/interactions.css">
    <link rel="stylesheet" href="../styles/calendars_image_layout.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../calendars/calendars_img_upload.js"></script>
    <script src="../scripts/redirect.js"></script>
</head>

<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <?php include_once('../scripts/side_panel.php'); ?>
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">CALENDAR</p>
                </div>
                <div class="user-profile">
                    <?php include_once('../admin_account.php'); ?>
                    <a href="../logout.php" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i> <!-- Font Awesome logout icon -->
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class="upload-container">
                        <form id="uploadForm" action="calendars_upload.php" method="post" enctype="multipart/form-data">
                            <div class="upload-button">
                                <label for="fileInput" class="upload-title">
                                    Upload <i class="fas fa-upload"></i>
                                </label>
                                <input type="file" name="fileInput" id="fileInput" accept=".jpg, .jpeg, .png" style="position: absolute; opacity: 0;" onchange="displayFileName(this)">
                            </div>
                        </form>
                        <input type="text" name="calendarIdentifier" id="calendarIdentifier" placeholder="Calendar Identifier" required>
                        <input type="text" name="category" id="category" placeholder="Category" required>
                        <input type="submit" class="submit-button" onclick="submitForm()"></>
                        <div class="category-filter">
                            <label for="categorySelect">Select Category:</label>
                            <select id="categorySelect" onchange="filterCalendars()">
                                <option value="All">All</option>
                                <option value="SHS">Senior High School</option>
                                <option value="Undergraduate">Undergraduate</option>
                                <option value="Graduate">Graduate School</option>
                            </select>
                        </div>
                    </div>
                    <div class="calendars-imgs">
                        <?php include 'calendars_images.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function displayFileName(input) {
            var fileName = input.files[0].name;
            var label = document.querySelector('.upload-title');
            label.innerHTML = 'Upload (' + fileName + ') <i class="fas fa-upload"></i>';
        }

        function submitForm() {
            var form = document.getElementById('uploadForm');
            var calendarIdentifier = document.getElementById('calendarIdentifier').value;
            var category = document.getElementById('category').value;

            // Create hidden input fields to append to the form
            var hiddenIdentifier = document.createElement('input');
            hiddenIdentifier.type = 'hidden';
            hiddenIdentifier.name = 'calendarIdentifier';
            hiddenIdentifier.value = calendarIdentifier;

            var hiddenCategory = document.createElement('input');
            hiddenCategory.type = 'hidden';
            hiddenCategory.name = 'category';
            hiddenCategory.value = category;

            form.appendChild(hiddenIdentifier);
            form.appendChild(hiddenCategory);

            form.submit();
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>