<?php
session_start();

// If the user is already logged in, redirect them to the appropriate page based on their role
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user_dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Housekeeping Service</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- External CSS file -->
</head>
<body class="login-page">
    <div class="login-container">
        <form method="POST" action="login_handler.php" class="login-form">
            <h2>Login to Your Account</h2>

            <!-- Display Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Login</button>
                <a href="signup.php" class="signup-link">Don't have an account? Sign up</a>
            </div>
        </form>
    </div>
</body>
</html>

