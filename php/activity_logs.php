<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch activity logs
$sql = "SELECT * FROM activity_logs ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
</head>
<body>
    <h1>Activity Logs</h1>

    <!-- Display Activity Logs -->
    <table>
        <thead>
            <tr>
                <th>Log ID</th>
                <th>User ID</th>
                <th>Activity</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['activity']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
