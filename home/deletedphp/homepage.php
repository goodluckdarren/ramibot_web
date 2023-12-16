<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ADMIBOT</title>
        <link rel="stylesheet" href="../home/homepage.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <script src="redirect.js"></script>
    </head>
    <body class="home-page">
        <div class="top-header">
            <div class="main-logo">
                <img id="apc-soe-logo" src="../home/SOELOGO.png" width="340px" height="93px">
            </div>
        </div>
        <div class="main-menu">
            <div class="side-panel">
                <div class="home-btn-group">
                     <div class="btn home-button" onclick="redirectToHome()">
                        <p class="home-text">Home</p>
                    </div>
                    <div class="btn new-user-files" onclick="redirectToUserFiles()">
                        <p>New User Files</p>
                    </div>
                    <div class="btn faculty-schedule" onclick="redirectToSchedule()">
                        <p>Faculty Schedule</p>
                    </div>
                    <div class="btn programs-offered" onclick="redirectToProgramsOffered()">
                        <p>Programs Offered</p>
                    </div>
                    <div class="btn office-hours" onclick="redirectToOfficeHours()">
                        <p>Office Hours</p>
                    </div>
                    <div class="btn announcements" onclick="redirectToAnnouncements()">
                        <p>Announcements</p>
                    </div>
                </div>
            </div>
            <div class="main-panel">
            <img id="temp-announcements" src="..\home\homeannouncement.PNG" width= "90%" height="90%" alt="announcement image">

            </div>
        </div>

    </body>
</html>