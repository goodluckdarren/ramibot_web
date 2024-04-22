function redirectToSchedule(){
    window.location.href = '../facultysched/faculty_schedule.php';
}

function redirectToProgramsOffered(){
    window.location.href = '../programs/programs_offered.php';
}

function redirectToOfficeHours(){
    window.location.href = '../officesched/office_hours.php';
}

function redirectToAnnouncements(){
    window.location.href = '../announcements/announcements.php';
}

function redirectToUserFiles(){
    window.location.href = '../userfiles/new_user_files.php';
}

function redirectToStatus(){
    window.location.href = '../status/rami_status.php';
}

function redirectToFloors(){
    window.location.href = '../floors/floors.php';
}

function redirectToCalendar(){
    window.location.href = '../calendars/calendars.php';
}

function toggleAddForm() {
    var addForm = document.getElementById("addForm");
    addForm.style.display = (addForm.style.display === "none" || addForm.style.display === "") ? "block" : "none";
}

// Initially disable the Start Scan button
document.getElementById("lidar-start").disabled = true;

function toggleLidarForm() {
    var lidarForm = document.getElementById("lidarForm");
    var startScanButton = document.getElementById("lidar-start");

    if (lidarForm.style.display === "none" || lidarForm.style.display === "") {
        // Show the form and disable the Start Scan button
        lidarForm.style.display = "block";
        startScanButton.disabled = true;
    } else {
        // Hide the form and enable the Start Scan button if it's confirmed
        if (startScanButton.dataset.confirmed === "true") {
            startScanButton.disabled = false;
        }
        lidarForm.style.display = "none";
    }
}

function confirmUpdate() {
    // Your confirmation logic goes here

    // After confirming, set the dataset attribute to true
    document.getElementById("lidar-start").dataset.confirmed = "true";

    // Enable the Start Scan button
    document.getElementById("lidar-start").disabled = false;

    // Hide the lidarForm
    document.getElementById("lidarForm").style.display = "none";
}

function startScan() {
    // Disable the Start Scan button after it's clicked
    document.getElementById("lidar-start").disabled = true;

    // Log that the function is being executed
    console.log("Starting scan...");

    // AJAX request to update status in the database
    updateStatus('lidar', function (response) {
        console.log("Response from server:", response);

        // Enable the Start Scan button after the AJAX request completes
        document.getElementById("lidar-start").disabled = false;
    });
}

function updateStatus(statusType, callback) {
    $.ajax({
        type: "POST",
        url: "update_status.php",
        data: { statusType: statusType },
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            console.error("Error updating status:", error);
            callback(null);
        }
    });
}

function updatePositioningStatus(callback) {
    // AJAX request to update Positioning status in the database
    updateStatus('positioning', function (response) {
        console.log("Response from server:", response);

        // Invoke the callback function after the AJAX request completes
        if (callback) {
            callback(response);
        }

        // Toggle the lidarForm after confirming
        toggleLidarForm();
    });
}







// function toggleSidePanel() {
//     var sidePanel = document.getElementById("sidePanel");
//     sidePanel.classList.toggle("minimized");
// }