<?php
    require_once('../database_connect.php');

// Assuming you have a database table named 'users'
$mysqli = new mysqli("localhost", "username", "password", "your_database");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Sanitize input (to prevent SQL injection)
$idNumber = mysqli_real_escape_string($mysqli, $_POST['idInput']);
$profession = mysqli_real_escape_string($mysqli, $_POST['professionInput']);
$lastName = mysqli_real_escape_string($mysqli, $_POST['lastNameInput']);
$givenName = mysqli_real_escape_string($mysqli, $_POST['givenNameInput']);
$middleInitial = mysqli_real_escape_string($mysqli, $_POST['middleInitialInput']);
$nickname = mysqli_real_escape_string($mysqli, $_POST['nicknameInput']);

// Insert data into the database
$sql = "INSERT INTO users (Id_number, Profession, Last_Name, Given_Name, MI, nickname) VALUES ('$idNumber', '$profession', '$lastName', '$givenName', '$middleInitial', '$nickname')";

if ($mysqli->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
