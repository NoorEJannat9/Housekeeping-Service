<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch all users
$result = $conn->query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="admin-dashboard">
        <header>
            <div class="header-left">
                <h2>Manage Users</h2>
            </div>
            <div class="header-right">
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="manage_users.php">Manage Users</a></li>
                    <!-- Add other links as needed -->
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h3>All Users</h3>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> | 
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
