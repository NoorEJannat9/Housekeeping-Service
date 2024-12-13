<?php
// view_services.php
include('db_config.php');

$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Services</title>
</head>
<body>
    <h1>Services</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Created At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['duration'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
