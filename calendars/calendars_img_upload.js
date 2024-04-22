// uploadScript.js

document.getElementById('fileInput').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const fileInput = event.target;
    const files = fileInput.files;

    if (files.length > 0) {
        const file = files[0];

        if (validateFile(file)) {
            uploadFile(file);
        } else {
            alert('Please select a valid image file (jpg, jpeg, or png).');
        }
    }
}

function validateFile(file) {
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    return allowedExtensions.test(file.name);
}

function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);

    // Use XMLHttpRequest or Fetch API to send the file to the server
    // Example using Fetch API
    fetch('/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Assuming the server responds with the URL
        const imageUrl = data.imageUrl;

        // Now you can save the imageUrl in your database
        saveImageUrlToDatabase(imageUrl);
    })
    .catch(error => {
        console.error('Error uploading file:', error);
    });
}

function saveImageUrlToDatabase(imageUrl) {
    // Implement code to save the imageUrl to your database here
    console.log('Image URL saved to database:', imageUrl);
}


function getCategory(calendarText) {
    var words = calendarText.split(' ');
    return words[0];
}

function filterCalendars() {
    var categorySelect = document.getElementById("categorySelect");
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

