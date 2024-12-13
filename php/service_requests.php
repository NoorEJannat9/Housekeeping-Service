<?php
session_start();
include('db_config.php');

// Fetch service requests
$sql = "SELECT sr.id, sr.user_id, sr.service_id, sr.request_date, sr.status, s.name as service_name, u.username as user_name
        FROM service_requests sr
        JOIN services s ON sr.service_id = s.id
        JOIN users u ON sr.user_id = u.id";
$result = $conn->query($sql);

// Update service request status functionality
if (isset($_POST['update_status'])) {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    $sql = "UPDATE service_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $request_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Service request status updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating service request status!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
</head>
<body>
    <h1>Service Requests</h1>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Display Service Requests -->
    <h2>All Service Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>User</th>
                <th>Service</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['service_name']; ?></td>
                    <td><?php echo $row['request_date']; ?></td>
                    <td>
                        <form method="POST" action="service_requests.php">
                            <select name="status">
                                <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="In Progress" <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                                <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            </select>
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="update_status">Update Status</button>
                        </form>
                    </td>
                    <td>
                        <a href="view_request.php?id=<?php echo $row['id']; ?>">View Details</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
