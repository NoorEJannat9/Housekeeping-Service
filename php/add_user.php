<?php
include('db_config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "INSERT INTO users (username, role) VALUES ('$username', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "User added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <h1>Add User</h1>
    <form action="add_user.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="role">Role:</label>
        <input type="text" name="role" required><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>

<?php
$conn->close();
?>
