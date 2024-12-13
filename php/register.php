<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Insert query
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="role" placeholder="Role (Admin/User)" required>
    <button type="submit">Register</button>
</form>
