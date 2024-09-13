<?php require_once('../database_connect.php') ?>

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
                    <img class="profile-picture" src="" alt="Image of Admin" width="70px" height="70px">
                </div>
            </div>
            <div class="main-menu">
                <div class="main-panel">
                    <!-- Users Table Container -->
                    <div class="users-table-container">
                        <div id="user-management-table-content">
                            <?php include('users_table.php'); ?>
                        </div>
                        <!-- Pagination for Users Table -->
                        <ul id="users-pagination" class="pagination"></ul>
                    </div>

                    <!-- User Logs Section -->
                    <h2>User Activity Logs</h2>
                    <div class="user-logs-container">
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
                        <!-- Pagination for User Logs Table -->
                        <ul id="logs-pagination" class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
