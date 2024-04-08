<?php
    require_once('../database_connect.php');

    $stmt = $con->prepare("INSERT INTO ramibot_faces (ID_Number, Profession, Last_Name, Given_Name, MI, nickname) 
            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $idNumber, $profession, $lastName, $givenName, $middleInitial, $nickname);

    $idNumber = $_POST['idInput'];
    $profession = $_POST['professionInput'];
    $lastName = $_POST['lastNameInput'];
    $givenName = $_POST['givenNameInput'];
    $middleInitial = $_POST['middleInitialInput'];
    $nickname = $_POST['nicknameInput'];

    if ($stmt->execute()) {
        echo "Record added successfully";
        echo '<br><button onclick="goBack()">Okay</button>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
?>

<script>
    function goBack() {
        window.history.back();
    }
</script>
