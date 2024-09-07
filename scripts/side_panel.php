<?php 
    require_once('../database_connect.php');

    // Check the logged-in user's role from the session
    $userID = $_SESSION['user_id'];

    // Query to get all admin accounts
    $sql = "SELECT * FROM admin_accounts WHERE user_id = $userID";
    $result = mysqli_query($con, $sql);

    if ($result === false) {
        die("Failed to connect with MySQL: " . mysqli_error($con));
    }

    // Initialize a flag to check if any user has role 1
    $hasRole1 = false;

    // Check if any user has role 1
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['role'] == 1) {
            $hasRole1 = true;
            break; // No need to check further if we already found a user with role 1
        }
    }

    // Get the current page
    $currentPage = basename($_SERVER['REQUEST_URI']);
    
    // Function to check if a page is active
    function isActivePage($page) {
        global $currentPage;
        return $currentPage === basename($page) ? 'main-btn btn-indicator' : '';
    }

    // HTML for buttons
    $buttons = [
        ['path' => '../super_admin/manage_users.php', 'label' => 'Manage Users'],
        ['path' => '../facultysched/faculty_schedule.php', 'label' => 'Faculty Schedule'],
        ['path' => '../programs/programs_offered.php', 'label' => 'Programs Offered'],
        ['path' => '../floors/floors.php', 'label' => 'Floors'],
        ['path' => '../offices/office_hours.php', 'label' => 'Office Hours'],
        ['path' => '../announcements/about.php', 'label' => 'About APC'],
        ['path' => '../status/rami_status.php', 'label' => 'Status'],
        ['path' => '../calendars/calendars.php', 'label' => 'Calendar'],
        ['path' => '../tuition/tuition.php', 'label' => 'Tuition'],
        ['path' => '../accreditations/accreditations.php', 'label' => 'Accreditations']
    ];

    foreach ($buttons as $button) {
        if ($hasRole1 || !isset($button['path']) || !str_contains($button['path'], 'manage_users') && !str_contains($button['path'], 'rami_status')) {
            echo '<div class="btn ' . isActivePage($button['path']) . '" onclick="redirectPage(\'' . $button['path'] . '\')">';
            echo '<p>' . $button['label'] . '</p>';
            echo '</div>';
        }
    }
?>
