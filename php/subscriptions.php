<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch subscription data from the database
$sql = "SELECT * FROM subscriptions ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions</title>
</head>
<body>
    <h1>Manage Subscriptions</h1>

    <!-- Display Subscriptions -->
    <table>
        <thead>
            <tr>
                <th>Subscription ID</th>
                <th>User ID</th>
                <th>Plan ID</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['plan_id']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td>
                        <a href="edit_subscription.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete_subscription.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
