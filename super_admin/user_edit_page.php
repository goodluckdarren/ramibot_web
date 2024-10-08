<?php
require_once('../database_connect.php');

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $query = "SELECT * FROM admin_accounts WHERE user_id = '$userId'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        echo 'User not found.';
        exit();
    }

    $roleQuery = "SELECT role_id, role_name FROM role_type";
    $roleResult = mysqli_query($con, $roleQuery);

    $roles = [];
    while ($row = mysqli_fetch_assoc($roleResult)) {
        $roles[] = $row;
    }
} else {
    echo 'Invalid user ID.';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../styles/edit_user.css"> <!-- Optional: Link to external CSS -->
    <script>
        function showStatusMessage(status) {
            if (status === 'success') {
                alert('User updated successfully!');
                window.location.href = 'manage_users.php'; 
                // add user log
            } else if (status === 'error') {
                alert('Failed to update user.');
            }
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            if (status) {
                showStatusMessage(status);
            }
        };
    </script>
</head>

<body>
    <h2>Editing User: <?php echo $userData['username']; ?></h2>

    <form action="user_edit_update.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">

        <label for="new_username">Username:</label>
        <input type="text" id="new_username" name="new_username" value="<?php echo $userData['username']; ?>" required><br>

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $userData['email']; ?>" required><br>

        <label for="new_password">New Password (leave blank to keep current):</label>
        <input type="password" id="new_password" name="new_password"><br>

        <label for="role_name">Role:</label>
        <select name="role_name" id="role_name" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role['role_id']; ?>"
                    <?php if ($role['role_id'] == $userData['role']) echo 'selected'; ?>>
                    <?php echo $role['role_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="user_status">Status:</label>
        <select name="user_status" id="user_status" required>
            <option value="1" <?php if ($userData['user_status'] == '1') echo 'selected'; ?>>Active</option>
            <option value="0" <?php if ($userData['user_status'] == '0') echo 'selected'; ?>>Inactive</option>
        </select><br>

        <button type="submit">Save Changes</button>
    </form>
</body>

</html>