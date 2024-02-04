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

function toggleAddForm() {
    var addForm = document.getElementById("addForm");
    addForm.style.display = (addForm.style.display === "none" || addForm.style.display === "") ? "block" : "none";
}

function toggleLidarForm() {
    var lidarForm = document.getElementById("lidarForm");
    lidarForm.style.display = (lidarForm.style.display === "none" || lidarForm.style.display === "") ? "block" : "none";

}

// function toggleSidePanel() {
//     var sidePanel = document.getElementById("sidePanel");
//     sidePanel.classList.toggle("minimized");
// }