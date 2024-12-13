<?php
session_start();
include('db_config.php');

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch posts from the database (assuming a posts table exists)
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
</head>
<body>
    <h1>Manage Posts</h1>

    <!-- Display Posts -->
    <table>
        <thead>
            <tr>
                <th>Post ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo substr($row['content'], 0, 50) . '...'; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
