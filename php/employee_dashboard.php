<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
    // Redirect if not an employee
    header('Location: login.php');
    exit();
}

include('db_config.php');

// Example query to fetch employee-specific data
$sql = "SELECT * FROM schedules WHERE employee_id = " . $_SESSION['user_id'];
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- External CSS -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to the Employee Dashboard</h1>
        <p>Hello, <?php echo $_SESSION['username']; ?>! You have employee privileges.</p>

        <h2>Your Scheduled Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Service</th>
                    <th>Scheduled Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['service_name'] ?></td>
                        <td><?= $row['scheduled_date'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
