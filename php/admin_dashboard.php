<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}


// Fetch user statistics
$user_count = $conn->query("SELECT COUNT(*) AS total_users FROM users")->fetch_assoc()['total_users'];
$subscription_count = $conn->query("SELECT COUNT(*) AS total_subscriptions FROM subscriptions")->fetch_assoc()['total_subscriptions'];
$service_request_count = $conn->query("SELECT COUNT(*) AS total_requests FROM service_requests")->fetch_assoc()['total_requests'];
$active_plans = $conn->query("SELECT COUNT(*) AS active_plans FROM plans WHERE status = 'active'")->fetch_assoc()['active_plans'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="admin-dashboard">
        <!-- Admin Header -->
        <header>
            <div class="header-left">
                <h2>Admin Dashboard</h2>
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
                    <li><a href="manage_plans.php">Manage Plans</a></li>
                    <li><a href="activity_logs.php">Activity Logs</a></li>
                    <li><a href="posts.php">Manage Posts</a></li>
                    <li><a href="subscriptions.php">Subscriptions</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <h3>Dashboard Overview</h3>
            <div class="stats">
                <div class="stat-item">
                    <h4>Total Users</h4>
                    <p><?php echo $user_count; ?></p>
                </div>
                <div class="stat-item">
                    <h4>Total Subscriptions</h4>
                    <p><?php echo $subscription_count; ?></p>
                </div>
                <div class="stat-item">
                    <h4>Total Service Requests</h4>
                    <p><?php echo $service_request_count; ?></p>
                </div>
                <div class="stat-item">
                    <h4>Active Plans</h4>
                    <p><?php echo $active_plans; ?></p>
                </div>
            </div>

            <h3>Recent Activity</h3>
            <div class="recent-activity">
                <ul>
                    <li><a href="manage_users.php">View all users</a></li>
                    <li><a href="service_requests.php">View service requests</a></li>
                    <li><a href="manage_services.php">Manage services</a></li>
                    <li>
                    <a href="#">Manage Subscription Plans</a>
                    <ul>
                    <li><a href="add_subscription.php">Add Subscriptions</a></li>
                    <li><a href="view_subscriptions.php">View Subscriptions</a></li>
                </ul>
                </li>
                </ul>
            </div>
        </main>
    </div>
</body>
</html>
