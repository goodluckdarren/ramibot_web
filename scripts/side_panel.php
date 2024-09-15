<?php  
require_once('../database_connect.php');

// Check the logged-in user's role from the session
$userID = $_SESSION['user_id'];

// Query to get the current user's role
$sql = "SELECT role FROM admin_accounts WHERE user_id = $userID";
$result = mysqli_query($con, $sql);

if ($result === false) {
    die("Failed to connect with MySQL: " . mysqli_error($con));
}

// Fetch the user's role
$userRole = null;
if ($row = mysqli_fetch_assoc($result)) {
    $userRole = $row['role'];
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
    ['path' => '../accreditations/accreditations.php', 'label' => 'Accreditations'],
    ['path' => '../intents/intents.php', 'label' => 'Ramibot Response'],
    ['path' => '../buttons/buttons.php', 'label' => 'Button Lists']
];

foreach ($buttons as $button) {
    // Allow access for Role 1
    if ($userRole == 1) {
        echo '<div class="btn ' . isActivePage($button['path']) . '" onclick="redirectPage(\'' . $button['path'] . '\')">';
        echo '<p>' . $button['label'] . '</p>';
        echo '</div>';
    } 
    // Allow access for Role 2, but restrict 'manage_users.php'
    elseif ($userRole == 2 && $button['path'] !== '../super_admin/manage_users.php') {
        echo '<div class="btn ' . isActivePage($button['path']) . '" onclick="redirectPage(\'' . $button['path'] . '\')">';
        echo '<p>' . $button['label'] . '</p>';
        echo '</div>';
    } 
    // Restrict Role 3 from 'manage_users.php' and 'rami_status.php'
    elseif ($userRole == 3 && !(str_contains($button['path'], 'manage_users') || str_contains($button['path'], 'rami_status'))) {
        echo '<div class="btn ' . isActivePage($button['path']) . '" onclick="redirectPage(\'' . $button['path'] . '\')">';
        echo '<p>' . $button['label'] . '</p>';
        echo '</div>';
    }
}
?>
