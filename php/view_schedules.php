<?php
// view_schedules.php
include('db_config.php');

$sql = "SELECT * FROM schedules";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Schedules</title>
</head>
<body>
    <h1>Schedules</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['employee_id'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['start_time'] ?></td>
            <td><?= $row['end_time'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
