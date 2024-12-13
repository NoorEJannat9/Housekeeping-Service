<?php
// Include database configuration file
include('db_config.php');

// Set the number of records per page
$limit = 10;

// Get the current page from the URL parameter, default to page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $limit;

// Get the total number of records in the service_requests table
$sql = "SELECT COUNT(*) AS total FROM service_requests";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch the records for the current page
$sql = "SELECT * FROM service_requests LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Service Requests</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Link to external JavaScript -->
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Service Requests</h1>

        <!-- Table to display the service requests -->
        <table border="1">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Service ID</th>
                <th>Special Requests</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['service_id'] ?></td>
                <td><?= $row['special_requests'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            <?php
            // Display pagination links
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='view_service_requests.php?page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

