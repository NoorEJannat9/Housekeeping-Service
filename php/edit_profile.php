<?php
session_start();
include('db_config.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details for editing
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $update_sql = "UPDATE users SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $full_name, $email, $phone_number, $address, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header('Location: view_profile.php');
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Profile edit form -->
    <form method="POST">
        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

        <button type="submit">Update Profile</button>
    </form>
    
    <a href="view_profile.php">Back to Profile</a>
</body>
</html>
