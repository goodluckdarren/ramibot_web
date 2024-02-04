<?php require_once('../database_connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title> 
    <link rel="stylesheet" href="../homepage.css">
    <link rel="stylesheet" href="../interactions.css">
    <link rel="stylesheet" href="../userfiles/userfiles_style/sort_search_style.css">
    <link rel="stylesheet" href="../userfiles/userfiles_style/info_user_files_table.css">
    <link rel="stylesheet" href="../userfiles/userfiles_style/add_user_form_style.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/redirect.js"></script>
</head>
<body class="home-page">
    <div class="container">
        <div class="side-panel" id="sidePanel">
            <div class="home-btn-group">
                <div class="main-btn btn new-user-files" onclick="redirectToUserFiles()">
                    <div class="main-btn-box"></div>
                    <p>User Files</p>  
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
                <div class="btn status" onclick="redirectToStatus()">
                    <p>Status</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">USER FILES</p>
                </div>
                <div class="user-profile">
                    <p class="user-name">BARACK OBAMA</p>
                    <img class ="profile-picture" src="../images_home/obama sample.jpg" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class = "sort-search-box">
                        <div class = "search-box">
                            <p class="sort-search-title">Search:</p>
                            <input class="search-input" type="text" id="search-input" name="search" placeholder="Search..">
                        </div>
                        <div class = "sort-box">
                            <p class="sort-search-title">Sort by:</p>
                            <select class="sort-select" name="sort" id="sort-select">
                                <option value="id_number">ID Number</option>
                                <option value="profession">Profession</option>
                                <option value="last_name">Last Name</option>
                                <option value="given_name">Given Name</option>
                                <option value="middle_initial">Middle Initial</option>
                                <option value="nickname">Nickname</option>
                            </select>
                        </div>
                        <div class="add-container">
                            <div class="add-button" onclick="toggleAddForm()">
                                <i class="fas fa-plus"></i>&#160Add
                            </div>
                        </div>
                    </div>
                    <div class="add-form-container" id="addForm" style="display: none;">
                        <form action = "add_new_user.php" method="POST">
                            <!-- Your form fields go here -->
                            <input type="text" name="idInput" placeholder="ID Number" required>
                            <input type="text" name="professionInput" placeholder="Profession" required>
                            <input type="text" name="lastNameInput" placeholder="Last Name" required>
                            <input type="text" name="givenNameInput" placeholder="Given Name" required>
                            <input type="text" name="middleInitialInput" placeholder="Middle Initial" required>
                            <input type="text" name="nicknameInput" placeholder="Nickname" required>
                            <input type="submit" value="Add to Database">
                        </form>
                    </div>
                    <div class = "table-container">
                    <table class="user-files-table">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Profession</th>
                                <th>Last Name</th>
                                <th>Given Name</th>
                                <th>Middle Initial</th>
                                <th>Nickname</th>
                            </tr>
                        </thead>
                        <tbody id="user-files-table-content">
                        <?php include '../userfiles/user_files_table.php'?>
                        </tbody>
                    </table>
                    </div>
                    <ul id="pagination" class="pagination">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>