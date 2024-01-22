<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../homepage.css">
    <link rel="stylesheet" href="../interactions.css">
    <link rel="stylesheet" href="../programs/programs_offered_table.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/redirect.js"></script>
    <script>// uploadScript.js

document.getElementById('fileInput').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const fileInput = event.target;
    const files = fileInput.files;

    if (files.length > 0) {
        const file = files[0];

        if (validateFile(file)) {
            uploadFile(file);
        } else {
            alert('Please select a valid image file (jpg, jpeg, or png).');
        }
    }
}

function validateFile(file) {
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    return allowedExtensions.test(file.name);
}

function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);

    // Use XMLHttpRequest or Fetch API to send the file to the server
    // Example using Fetch API
    fetch('/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Assuming the server responds with the URL
        const imageUrl = data.imageUrl;

        // Now you can save the imageUrl in your database
        saveImageUrlToDatabase(imageUrl);
    })
    .catch(error => {
        console.error('Error uploading file:', error);
    });
}

function saveImageUrlToDatabase(imageUrl) {
    // Implement code to save the imageUrl to your database here
    console.log('Image URL saved to database:', imageUrl);
}
</script>
    <script src="../programs/program_img_upload.js"></script>

</head>
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
                <div class="main-btn btn programs-offered" onclick="redirectToProgramsOffered()">
                    <div class="main-btn-box"></div>
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
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">PROGRAMS OFFERED</p>
                </div>
                <div class="user-profile">
                    <p class="user-name">BARACK OBAMA</p>
                    <img class ="profile-picture" src="../images_home/obama sample.jpg" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class="upload-container">
                        <div class="upload-button">    
                            <label for="fileInput" class="upload-title">Upload
                                <i class="fas fa-upload"></i>
                            </label>
                            <input type="file" id="fileInput" accept=".jpg, .jpeg, .png" style="display:none">
                        </div>
                    </div>
                    <div class="programs-imgs">
                    <?php include '../programs/programs_table.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
