<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../homepage.css">
    <link rel="stylesheet" href="../interactions.css">
    <link rel="stylesheet" href="about_table.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/redirect.js"></script>
    <script src="about_image_upload.js"></script>
</head>
<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <!-- <div class="btn new-user-files" onclick="redirectToUserFiles()">
                    <p>User Files</p>
                </div> -->
                <div class="btn faculty-schedule" onclick="redirectToSchedule()">
                    <p>Faculty Schedule</p>
                </div>
                <div class="btn programs-offered" onclick="redirectToProgramsOffered()">
                    <p>Programs Offered</p>
                </div>
                <div class="btn floors" onclick="redirectToFloors()">
                    <p>Floors</p>
                </div>
                <div class="btn office-hours" onclick="redirectToOfficeHours()">
                    <p>Office Hours</p>
                </div>
                <div class="main-btn btn announcements" onclick="redirectToAnnouncements()">
                    <div class="main-btn-box"></div>    
                    <p>About APC</p>
                </div>
                <div class="btn status" onclick="redirectToStatus()">
                    <p>Status</p>
                </div>
                <div class="btn calendar"onclick="redirectToCalendar()">
                    <p>Calendar</p>
                </div>       
                <div class="btn tuition" onclick="redirectToTuition()">
                    <p>Tuition</p>    
                </div> 
                <div class="btn accreditations" onclick="redirectToTuition()">
                    <p>Accreditations</p>    
                </div> 
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">ABOUT APC</p>
                </div>
                <div class="user-profile">
                <?php include_once('../admin_account.php');?>
                    <img class ="profile-picture" src="" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                <form action="about_upload.php" method="post" enctype="multipart/form-data" onsubmit="return showFileName()">
                    <div class="upload-container">
                        <div class="upload-button">    
                            <label for="fileInput" class="upload-title">
                                Upload <i class="fas fa-upload"></i>
                            </label>
                            <input type="file" name="fileInput" id="fileInput" accept=".jpg, .jpeg, .png" style="position: absolute; opacity: 0;" onchange="displayFileName(this)">
                        </div>
                        <input type="text" name="aboutIdentifier" id="aboutIdentifier" placeholder="Image Identifier" required>
                        <input type="submit" value="Submit">
                    </div>
                    </form>
                    <div class="about-imgs">
                    <?php include '../announcements/about_images.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
