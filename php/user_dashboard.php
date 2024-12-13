<?php
session_start();
include('db_config.php');

// Ensure the user is logged in and has the correct role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
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

// Fetch user's active service requests
$sql_requests = "SELECT * FROM service_requests WHERE user_id = ? AND status != 'Completed'";
$stmt_requests = $conn->prepare($sql_requests);
$stmt_requests->bind_param("i", $user_id);
$stmt_requests->execute();
$requests = $stmt_requests->get_result();

// Fetch user's subscription status
$sql_subscription = "SELECT * FROM subscriptions WHERE user_id = ?";
$stmt_subscription = $conn->prepare($sql_subscription);
$stmt_subscription->bind_param("i", $user_id);
$stmt_subscription->execute();
$subscription = $stmt_subscription->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="user-dashboard">
        <!-- Header -->
        <header>
            <div class="header-left">
                <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?></h2>
            </div>
            <div class="header-right">
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="user_dashboard.php">Dashboard</a></li>
                    <li><a href="view_profile.php">View Profile</a></li>
                    <li><a href="service_requests.php">Service Requests</a></li>
                    <li><a href="subscriptions.php">My Subscriptions</a></li>
                    <li><a href="edit_profile.php">Edit Profile</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <h3>Your Dashboard</h3>

            <!-- Display User Information -->
            <div class="user-info">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            </div>

            <!-- Display Active Service Requests -->
            <h3>Your Active Service Requests</h3>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Request Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($requests->num_rows > 0): ?>
                        <?php while ($request = $requests->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($request['service_name']); ?></td>
                                <td><?php echo htmlspecialchars($request['status']); ?></td>
                                <td><?php echo htmlspecialchars($request['request_date']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No active service requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Display Subscription Information -->
            <h3>Your Subscription Status</h3>
            <?php if ($subscription): ?>
                <p><strong>Subscription Plan:</strong> <?php echo htmlspecialchars($subscription['plan_name']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($subscription['status']); ?></p>
            <?php else: ?>
                <p>You are not subscribed to any plan yet. <a href="subscriptions.php">Subscribe Now</a></p>
            <?php endif; ?>

        </main>
    </div>
</body>
</html>


