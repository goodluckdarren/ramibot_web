<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="programsIdentifier">Program Identifier:</label>
        <input type="text" name="programsIdentifier" id="programsIdentifier" required>
        <br><br>
        <label for="fileInput">Select Image:</label>
        <input type="file" name="fileInput" id="fileInput" accept="image/*" required>
        <br><br>
        <input type="submit" value="Upload Image">
    </form>
</body>
</html>
