<?php
session_start();
include('db_config.php');

// Check if the user is logged in and has the appropriate role
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
if (!$role || !in_array($role, ['Admin', 'Housekeeper'])) {
    header("Location: login.php");
    exit;
}

// Fetch assignments
$query = "SELECT a.id, sr.id AS request_id, e.name AS employee_name, a.status, a.assigned_at
          FROM assignments a
          JOIN employees e ON a.employee_id = e.id
          JOIN service_requests sr ON a.request_id = sr.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignments</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Service Assignments</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Request ID</th>
                <th>Employee Name</th>
                <th>Status</th>
                <th>Assigned At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['request_id']; ?></td>
                    <td><?= $row['employee_name']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['assigned_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
