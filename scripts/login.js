function showPassword() {
    var x = document.getElementById("password_field");
    var icon = document.querySelector('.fa-eye');
    if (x.type === "password") {
        x.type = "text";
        icon.style.color = "#007BFF";
    } else {
        x.type = "password";
        icon.style.color = "#343A40";
    }
}

function closePopup() {
    document.getElementById('errorPopup').style.display = 'none';
}

function showPopup() {
    document.getElementById('errorPopup').style.display = 'block';
}

window.onload = function() {
    if (window.location.search.includes('error')) {
        showPopup();
    }
}