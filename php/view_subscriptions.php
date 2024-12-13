<?php
// view_subscriptions.php
include('db_config.php');

$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Subscriptions</title>
</head>
<body>
    <h1>Subscriptions</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Plan ID</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['plan_id'] ?></td>
            <td><?= $row['start_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
