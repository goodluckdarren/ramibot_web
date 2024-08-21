<?php require_once('../database_connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title> 
    <link rel="stylesheet" href="../homepage.css">
    <link rel="stylesheet" href="../interactions.css">
    <link rel="stylesheet" href="../status/lidar_status_style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/redirect.js"></script>
</head>
<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <div class="btn faculty-schedule" onclick="redirectPage('../facultysched/faculty_schedule.php')">
                    <p>Faculty Schedule</p>
                </div>
                <div class="btn programs-offered" onclick="redirectPage('../programs/programs_offered.php')">
                    <p>Programs Offered</p>
                </div>
                <div class="btn floors" onclick="redirectPage('../offices/office_hours.php')">
                    <p>Floors</p>
                </div>
                <div class="btn office-hours" onclick="redirectPage('../offices/office_hours.php')">
                    <p>Office Hours</p>
                </div>
                <div class="btn announcements" onclick="redirectPage('../announcements/about.php')">
                    <p>About APC</p>
                </div>
                <div class="main-btn btn status" onclick="redirectPage('../status/rami_status.php')">
                    <div class="main-btn-box"></div>
                    <p>Status</p>
                </div>
                <div class="btn calendar" onclick="redirectPage('../calendars/calendars.php')">
                    <p>Calendar</p>
                </div>
                <div class="btn tuition" onclick="redirectPage('../tuition/tuition.php')">
                    <p>Tuition</p>
                </div>
                <div class="btn accreditations" onclick="redirectPage('../accreditations/accreditations.php')">
                    <p>Accreditations</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">RAMIBOT STATUS</p>
                </div>
                <div class="user-profile">
                    <?php include_once('../admin_account.php');?>
                    <img class ="profile-picture" src="" alt="Image of Admin" width="70px" height="70px">
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