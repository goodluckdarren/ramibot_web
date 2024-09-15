<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/interactions.css">
    <link rel="stylesheet" href="../styles/faculty_table.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/redirect.js"></script>
    <script src="../scripts/program_img_upload.js"></script>
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
                    <p class="page-name">FACULTY SCHEDULE</p>
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
                    <form action="faculty_upload.php" method="post" enctype="multipart/form-data" onsubmit="return showFileName()">
                        <div class="upload-container">
                            <div class="upload-button">
                                <label for="fileInput" class="upload-title">
                                    Upload <i class="fas fa-upload"></i>
                                </label>
                                <input type="file" name="fileInput" id="fileInput" accept=".jpg, .jpeg, .png" style="position: absolute; opacity: 0;" onchange="displayFileName(this)" required>
                            </div>
                            <input type="text" name="faculty_name" id="faculty_name" placeholder="Full Name" required>
                            <input type="text" name="school" id="school" placeholder="Department" required>
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                    <div class="scheds-imgs">
                        <?php include 'faculty_images.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>