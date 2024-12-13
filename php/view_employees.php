<?php
// Include the database connection
include('db_config.php');

// Handle specialization filter
$specialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';

// Modify the query based on specialization filter
$query = "SELECT * FROM employees";  // Default query to fetch all employees
if ($specialization) {
    $query .= " WHERE specialization = '$specialization'";  // Add filter if specialization is selected
}

// Execute the query
$result = $conn->query($query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch all employees
$employees = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <link rel="stylesheet" href="style.css">  <!-- Link to your CSS file -->
</head>
<body>

<!-- Navbar -->
<?php include('navbar.php'); ?>

<!-- Main Content -->
<div class="container">
    <h1>Employees List</h1>

    <!-- Employee Filter Form -->
    <form method="GET" action="view_employees.php">
        <label for="specialization">Specialization:</label>
        <select name="specialization">
            <option value="">All</option>
            <option value="Cleaner" <?php echo ($specialization == 'Cleaner') ? 'selected' : ''; ?>>Cleaner</option>
            <option value="Cook" <?php echo ($specialization == 'Cook') ? 'selected' : ''; ?>>Cook</option>
            <option value="Driver" <?php echo ($specialization == 'Driver') ? 'selected' : ''; ?>>Driver</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Employee Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employees): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['id']); ?></td>
                        <td><?php echo htmlspecialchars($employee['name']); ?></td>
                        <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['specialization']); ?></td> <!-- Updated to specialization -->
                        <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No employees found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
