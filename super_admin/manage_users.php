<?php require_once('../verify_login.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link rel="stylesheet" href="../styles/interactions.css">
    <link rel="stylesheet" href="../styles/super_admin.css">
    <link rel="stylesheet" href="../styles/table.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/redirect.js"></script>
    <script src="../scripts/program_img_upload.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleAddUserForm() {
            const form = document.getElementById("addUserForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
        
        function closeAddUserForm() {
            document.getElementById("addUserForm").style.display = "none";
        }
    </script>
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
                    <p class="page-name">MANAGE USERS</p>
                </div>
                <div class="user-profile">
                    <?php include_once('../admin_account.php'); ?>
                    <a href="../logout.php" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <div class="users-table-container">
                        <div id="user-management-table-content">
                            <?php include('users_table.php'); ?>
                        </div>
                        <div class="add-container">
                            <div class="add-button" onclick="toggleAddUserForm()">
                                <i class="fas fa-plus"></i>&#160Add User
                            </div>
                        </div>
                    </div>
                    <div id="addUserForm" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeAddUserForm()">&times;</span>
                            <h2>Add New User</h2>
                            <form action="add_user.php" method="POST">
                                <input type="text" name="emailInput" placeholder="Email" required>
                                <input type="text" name="usernameInput" placeholder="Username" required>
                                <input type="password" name="passwordInput" placeholder="Password" required>
                                <select name="roleInput" required>
                                    <option value="">Select Role</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Administrator</option>
                                    <option value="3">Admissions</option> 
                                </select>
                                <select name="statusInput" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                                <input type="submit" value="Add User">
                            </form>
                        </div>
                    </div>
                    <div class="user-logs-container">
                        <h2 class="user-logs-title">User Activity Logs</h2>
                        <table class="logs-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody id="user-logs-table-content">
                                <?php include('user_logs_table.php'); ?>
                            </tbody>
                        </table>
                        <ul id="logs-pagination" class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


