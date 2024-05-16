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
                <div class="btn floors" onclick="redirectToFloors()">
                    <p>Floors</p>
                </div>
                <div class="btn office-hours" onclick="redirectToOfficeHours()">
                    <p>Office Hours</p>
                </div>
                <div class="btn announcements" onclick="redirectToAnnouncements()">
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
                <div class="btn accreditations" onclick="redirectToAccreditation()">
                    <p>Accreditations</p>    
                </div>         
            </div>
        </div>
        <div class="content">
            <div class="top-header">
                <div class="page-title">
                    <p class="page-name">USER FILES</p>
                </div>
                <div class="user-profile">
                    <?php include_once('../admin_account.php');?>
                    <img class ="profile-picture" src="../images_home/obama sample.jpg" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class = "sort-search-box">
                        <div class = "search-box">
                            <p class="sort-search-title">Search:</p>
                            <input class="search-input" type="text" id="search-input" name="search" placeholder="Search.." oninput="searchTable()">
                        </div>
                        <div class="sorting-dropdown">
                            <label for="sort-by">Sort by:</label>
                            <select id="sort-by" onchange="sortTable()">
                                <option value="ID_Number">ID Number</option>
                                <option value="Profession">Profession</option>
                                <option value="Last_Name">Last Name</option>
                                <option value="Given_Name">Given Name</option>
                                <option value="MI">Middle Initial</option>
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
                            <input type="text" name="idInput" placeholder="ID Number" required>
                            <input type="text" name="professionInput" placeholder="Profession" required>
                            <input type="text" name="lastNameInput" placeholder="Last Name" required>
                            <input type="text" name="givenNameInput" placeholder="Given Name" required>
                            <input type="text" name="middleInitialInput" placeholder="Middle Initial" required>
                            <input type="text" name="nicknameInput" placeholder="Nickname" required>
                            <input type="submit" value="Add to Database">
                        </form>
                    </div>
                    <div id="editFormContainer" class="edit-form-container" style="display: none;">
                        <form id="editForm" class="edit-form" action="update_user.php" method="POST">
                            <input type="text" id="editIdNumber" name="editIdNumber" placeholder= "ID Number" required>
                            <input type="text" id="editProfession" name="editProfession" placeholder="Profession" required>
                            <input type="text" id="editLastName" name="editLastName" placeholder="Last Name" required>
                            <input type="text" id="editGivenName" name="editGivenName" placeholder="Given Name" required>
                            <input type="text" id="editMiddleInitial" name="editMiddleInitial" placeholder="Middle Initial" required>
                            <input type="text" id="editNickname" name="editNickname" placeholder="Nickname" required>
                            <input type="submit" value="Save Changes">
                            <button id="closeEditFormBtn" type="button">Close</button>
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
                                    <th>Modify</th>
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

<script>
    // Function to handle clicking the edit button
    function editRow(ID_Number) {
        // Your logic for editing a row goes here
        // For example, you can open a modal or populate a form for editing
        
        // Here, I'm setting the values of the edit form fields based on the row data
        $('#editIdNumber').val(ID_Number);
        $('#editProfession').val($('#profession_' + ID_Number).text());
        $('#editLastName').val($('#lastName_' + ID_Number).text());
        $('#editGivenName').val($('#givenName_' + ID_Number).text());
        $('#editMiddleInitial').val($('#middleInitial_' + ID_Number).text());
        $('#editNickname').val($('#nickname_' + ID_Number).text());
        
        // Show the edit form (assuming it's hidden by default)
        $('#editFormContainer').show();
    }

    // Submit edit form handler
    $('#editForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Get form data
        var idNumber = $('#editIdNumber').val();
        var profession = $('#editProfession').val();
        var lastName = $('#editLastName').val();
        var givenName = $('#editGivenName').val();
        var middleInitial = $('#editMiddleInitial').val();
        var nickname = $('#editNickname').val();

        // Send AJAX request to update user details
        $.ajax({
            url: 'update_user.php',
            type: 'POST',
            data: {
                editIdNumber: idNumber,
                editProfession: profession,
                editLastName: lastName,
                editGivenName: givenName,
                editMiddleInitial: middleInitial,
                editNickname: nickname
            },
            success: function(response) {
                // Display success message
                alert(response);
                // Reload the page to reflect changes
                location.reload();
            },
            error: function(xhr, status, error) {
                // Display error message
                alert('Error updating user details: ' + error);
            }
        });
    });
</script>


<script>
    function filterCalendars() {
        var categorySelect = document.getElementById("sort-select");
        var selectedCategory = categorySelect.value.toLowerCase(); // Convert to lowercase for case-insensitive comparison
        var calendarContents = document.getElementsByClassName("calendar-content");

        console.log("Selected category:", selectedCategory); // Debug statement

        for (var i = 0; i < calendarContents.length; i++) {
            var calendarContent = calendarContents[i];
            var categoryText = calendarContent.querySelector(".category-text").innerText.trim().toLowerCase(); // Convert to lowercase

            console.log("Category text:", categoryText); // Debug statement

            if (selectedCategory === "all" || categoryText === selectedCategory) { // Use lowercase for comparison
                calendarContent.style.display = "block";
            } else {
                calendarContent.style.display = "none";
            }
        }
    }
</script>