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

function displayFileName(input) {
    var fileName = input.value.split('\\').pop();
    var uploadTitle = document.querySelector('.upload-title');
    uploadTitle.textContent = fileName;
    uploadTitle.title = fileName;
}

function showFileName() {
    var fileName = document.getElementById('fileInput').value;
    if (fileName === '') {
        alert('Please select a file');
        return false; // Prevent form submission if no file is selected
    }
    return true; // Allow form submission
}