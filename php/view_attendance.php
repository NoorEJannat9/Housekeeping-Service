<?php
session_start();
include('db_config.php');

// Check if the user is logged in and has the appropriate role
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
if (!$role || $role !== 'Admin') {
    header("Location: login.php");
    exit;
}

// Fetch attendance records
$query = "SELECT a.id, e.name AS employee_name, a.date, a.status 
          FROM attendance a
          JOIN employees e ON a.employee_id = e.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Employee Attendance</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['employee_name']; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td><?= $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
