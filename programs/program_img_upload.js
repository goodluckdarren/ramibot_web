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
