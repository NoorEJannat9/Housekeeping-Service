<?php
include('db_config.php');

// Pagination logic
$limit = 10;  // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get the total number of users
$sql = "SELECT COUNT(*) AS total FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch users for the current page
$sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Users</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='view_users.php?page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
