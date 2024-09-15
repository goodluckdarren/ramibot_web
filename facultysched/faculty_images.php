<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

$sql = "SELECT fm.* FROM faculty_scheds AS fm";
$result_table = mysqli_query($con, $sql);

$schedules = [];

// Group records by school
while ($row = mysqli_fetch_assoc($result_table)) {
    $school = $row['school'];
    if (!isset($schedules[$school])) {
        $schedules[$school] = [];
    }
    $schedules[$school][] = $row;
}

echo "<div class='school-container'>"; // Open school container outside the loop

foreach ($schedules as $school => $school_schedules) {
    echo "<div class='school-bar'>$school</div>";
    echo "<div class='schedule-wrapper'>";

    // Iterate through each schedule and split into two columns
    foreach ($school_schedules as $schedule) {
        $faculty_name = $schedule['faculty_name'];
        $sched_img = $schedule['img_url'];

        echo "<div class='sched-content'>
                <div class='sched-text'>
                    $faculty_name 
                    <button class='delete-button' type='button' onclick='deleteRow(" . $schedule['sched_id'] . ")' title='Delete this schedule'>
                        <i class='fas fa-times'></i> <!-- X icon -->
                    </button>
                </div>";
        
        if (empty($sched_img)) {
            echo "<h2>Professor doesn't have an available schedule.</h2>";
        } else { 
            echo "<img src='$sched_img' class='sched-image'>";
            echo "<div class='action-buttons'>
                    <!-- Button to delete only the image URL -->
                    <button class='delete-button' type='button' onclick='deleteImage(" . $schedule['sched_id'] . ")' title='Delete image URL'>
                        <i class='fas fa-trash'></i> <!-- Trash icon -->
                    </button>
                </div>";
        }   
        echo "</div>"; // Close sched-content
    }

    echo "</div>"; // Close schedule wrapper
}

echo "</div>"; // Close school container
?>

<script>    
    function deleteImage(sched_id) {
        if (confirm("Do you want to delete the image URL?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../facultysched/delete_faculty.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert("Image URL has been successfully deleted.");
                        location.reload(); // Reload the page to see the changes
                    } else {
                        alert("Error deleting image URL: " + xhr.responseText);
                    }
                }
            };
            xhr.send("sched_id=" + sched_id + "&action=delete_image"); // Send the schedule ID and action
        }
    }

    function deleteRow(sched_id) {
        if (confirm("Do you want to delete this schedule?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../facultysched/delete_faculty.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert("Schedule has been successfully deleted.");
                        location.reload(); // Reload the page to see the changes
                    } else {
                        alert("Error deleting schedule: " + xhr.responseText);
                    }
                }
            };
            xhr.send("sched_id=" + sched_id + "&action=delete_row"); // Send the schedule ID and action
        }
    }
</script>
