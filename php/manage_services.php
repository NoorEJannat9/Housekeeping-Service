<?php
session_start();
include('db_config.php');

// Add service functionality
if (isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $description, $price);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Service added successfully!";
    } else {
        $_SESSION['error'] = "Error adding service!";
    }
}

// Delete service functionality
if (isset($_GET['delete'])) {
    $service_id = $_GET['delete'];

    $sql = "DELETE FROM services WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Service deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting service!";
    }
}

// Fetch services for display
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
</head>
<body>
    <h1>Manage Services</h1>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Add Service Form -->
    <form method="POST" action="manage_services.php">
        <h2>Add New Service</h2>
        <label for="name">Service Name</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="description">Service Description</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <button type="submit" name="add_service">Add Service</button>
    </form>

    <!-- Display Existing Services -->
    <h2>Existing Services</h2>
    <table>
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
                        <a href="edit_service.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="manage_services.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
