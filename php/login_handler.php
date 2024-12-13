<?php
session_start();
include('db_config.php'); // Make sure to include your database connection

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Check if user exists
    $sql = "SELECT id, full_name, email, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];

            // Redirect to the appropriate dashboard based on role
            if ($user['role'] == 'admin') {
                // Redirect to Admin Dashboard
                header('Location: admin_dashboard.php');
            } elseif ($user['role'] == 'user') {
                // Redirect to User Dashboard
                header('Location: user_dashboard.php');
            } elseif ($user['role'] == 'employee') {
                // Redirect to Employee Dashboard
                header('Location: employee_dashboard.php');
            }
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password!";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found!";
        header('Location: login.php');
        exit();
    }
} else {
    // If the form wasn't submitted, redirect to login page
    header('Location: login.php');
    exit();
}
?>
