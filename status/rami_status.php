<?php require_once('../verify_login.php')?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/interactions.css">
    <link rel="stylesheet" href="../styles/lidar_status_style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <p class="page-name">RAMIBOT STATUS</p>
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
                    <div class="lidar-box">
                        <div class="lidar-header">
                            <p>LIDAR</p>
                        </div>
                        <div class="lidar-status">
                            <p>STATUS: <span id="lidar-status">OFF</span></p>
                            <div class="lidar-btns">
                                <button class="lidar-btn" id="prep-position" onclick="updatePositioningStatus()">POSITION</button>
                                <button class="lidar-btn" id="lidar-start" data-confirmed="false" onclick="startScan()">START SCAN</button>
                            </div>
                        </div>
                    </div>
                    <div class="instruction-container" id="lidarForm" style="display: none;">
                        <div class="instruction-popup-box">
                            <div class="instruction-header">
                                <p>POSITIONING RAMIBOT</p>
                            </div>
                            <div class="instruction-content">
                                <p>Are you sure you want to update the status of the LIDAR?</p>
                            </div>
                            <div class="instruction-btn-group">
                                <button class="instruction-btn" id="confirm-update" data-confirmed="false" onclick="confirmUpdate()">CONFIRM</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>