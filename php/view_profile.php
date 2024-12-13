<?php
session_start();
include('db_config.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
</head>
<body>
    <h1>View Profile</h1>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>

    <a href="edit_profile.php">Edit Profile</a>
    <a href="user_dashboard.php">Back to Dashboard</a>
</body>
</html>
