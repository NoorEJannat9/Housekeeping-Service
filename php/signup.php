<?php
session_start();
include('db_config.php'); // Ensure this includes a working database connection

if (isset($_POST['signup'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $referral_code = $_POST['referral_code'];
    $role = $_POST['role']; // Capture the role from the form

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: signup.php');
        exit();
    }

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username already exists.";
        header('Location: signup.php');
        exit();
    }

    // Insert the new user into the database
    $password_hash = password_hash($password, PASSWORD_BCRYPT); // Encrypt the password
    $sql = "INSERT INTO users (username, password, full_name, email, phone_number, address, referral_code, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $password_hash, $full_name, $email, $phone_number, $address, $referral_code, $role);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id; // Get the last inserted user ID

        // Log the activity in activity_logs
        $activity = "User registered";
        $log_sql = "INSERT INTO activity_logs (user_id, activity, created_at) VALUES (?, ?, NOW())";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bind_param("is", $user_id, $activity);

        if ($log_stmt->execute()) {
            $_SESSION['success'] = "Account created successfully. Please log in.";
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['error'] = "Error logging activity. Please contact support.";
            header('Location: signup.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Error creating account. Please try again.";
        header('Location: signup.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>

    <div class="signup-container">
        <h2>Sign Up</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="address">Address</label>
            <textarea id="address" name="address" required></textarea>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>

            <div class="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the <a href="terms.php">Terms and Conditions</a></label>
            </div>

            <label for="referral_code">Referral/Promo Code (Optional)</label>
            <input type="text" id="referral_code" name="referral_code">

            <input type="submit" name="signup" value="Sign Up">
        </form>
    </div>

</body>
</html>


