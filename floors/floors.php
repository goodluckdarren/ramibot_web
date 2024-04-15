<?php require_once('../database_connect.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../homepage.css">
    <link rel="stylesheet" href="../interactions.css">
    <link rel="stylesheet" href="../floors/floors_table.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/redirect.js"></script>
    <script>
        function displayFileName(input) {
            var fileName = input.value.split('\\').pop();
            var uploadTitle = document.querySelector('.upload-title');
            uploadTitle.textContent = fileName; 
            uploadTitle.title = fileName; 
        }

        function showFileName() {
            var fileName = document.getElementById('fileInput').value;
            if (fileName === '') {
                alert('Please select a file');
                return false; 
            }
            return true;
        }
    </script>
<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <div class="btn new-user-files" onclick="redirectToUserFiles()">
                    <p>User Files</p>  
                </div>
                <div class="btn faculty-schedule" onclick="redirectToSchedule()">
                    <p>Faculty Schedule</p>
                </div>
                <div class="btn programs-offered" onclick="redirectToProgramsOffered()">
                    <p>Programs Offered</p>
                </div>
                <div class="main-btn btn floors" onclick="redirectToFloors()">
                    <div class="main-btn-box"></div>
                    <p>Floors</p>
                </div>
                <div class="btn office-hours" onclick="redirectToOfficeHours()">
                    <p>Office Hours</p>
                </div>
                <div class="btn announcements" onclick="redirectToAnnouncements()">
                    <p>Announcements</p>
                </div>
                <div class="btn status" onclick="redirectToStatus()">
                    <p>Status</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">Floor Maps</p>
                </div>
                <div class="user-profile">
                    <p class="user-name">BARACK OBAMA</p>
                    <img class ="profile-picture" src="../images_home/obama sample.jpg" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <form action="floors_upload.php" method="post" enctype="multipart/form-data" onsubmit="return showFileName()">
                        <div class="upload-container">
                            <div class="upload-button">    
                                <label for="fileInput" class="upload-title">
                                    Upload <i class="fas fa-upload"></i>
                                </label>
                                <input type="file" name="fileInput" id="fileInput" accept=".jpg, .jpeg, .png" style="position: absolute; opacity: 0;" onchange="displayFileName(this)">
                            </div>
                            <input type="text" name="floorIdentifier" id="floorIdentifier" placeholder="Floor Identifier" required>
                            <input type="number" name="floorId" id="floorId" placeholder="Floor Number" required>
                            <input type="submit" value="Submit">
                        </div>
                     </form>
                    <div class="floors-imgs">
                    <?php include '../floors/floors_images.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
