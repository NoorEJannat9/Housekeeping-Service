<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch all plans from the database
$sql = "SELECT * FROM plans ORDER BY created_at DESC";
$result = $conn->query($sql);

// Delete plan functionality
if (isset($_GET['delete_id'])) {
    $plan_id = $_GET['delete_id'];

    // Delete the plan from the database
    $delete_sql = "DELETE FROM plans WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $plan_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Plan deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting plan!";
    }

    header("Location: manage_plans.php"); // Redirect after deletion
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subscription Plans</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="admin-dashboard">
        <header>
            <div class="header-left">
                <h2>Manage Subscription Plans</h2>
            </div>
            <div class="header-right">
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="manage_users.php">Manage Users</a></li>
                    <li><a href="service_requests.php">Service Requests</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_plans.php">Manage Subscription Plans</a></li>
                    <li><a href="activity_logs.php">Activity Logs</a></li>
                    <li><a href="posts.php">Manage Posts</a></li>
                    <li><a href="subscriptions.php">Subscriptions</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Success and Error Messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <h3>All Subscription Plans</h3>

            <!-- Button to Add a New Plan -->
            <a href="add_plan.php" class="btn btn-primary">Add New Plan</a>

            <!-- Table to Display All Plans -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo '$' . number_format($row['price'], 2); ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <a href="edit_plan.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <!-- Delete Button -->
                                <a href="manage_plans.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
