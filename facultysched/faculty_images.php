<?php
require_once('../database_connect.php');

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
                <div class='sched-text'>$faculty_name</div>
                <img src='$sched_img' class='sched-image'>
                <div class='action-button'>
                    <button class='delete-button' type='button' onclick='deleteRow(" . $schedule['sched_id'] . ")'>
                        <i class='fas fa-trash'></i>
                    </button>
                </div>
              </div>";
    }

    echo "</div>"; // Close schedule wrapper
}

echo "</div>"; // Close school container
?>






<script>    
     function deleteRow(sched_id) {
        if (confirm("Do you want to delete this?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../facultysched/delete_faculty.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert("Image has been successfully deleted.");
                        location.reload();
                    } else {
                        alert("Error deleting image: " + xhr.responseText);
                    }
                }
            };
            xhr.send("sched_id=" + sched_id);
        }
    }
</script>

