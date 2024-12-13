<?php
include('db_config.php');

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $special_requests = mysqli_real_escape_string($conn, $_POST['special_requests']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);

    // Insert the service request into the database
    $sql = "INSERT INTO service_requests (user_id, service_id, special_requests, status) 
            VALUES ('$user_id', '$service_id', '$special_requests', '$status')";

    if ($conn->query($sql) === TRUE) {
        $request_id = $conn->insert_id; // Get the ID of the newly added service request
        
        // Assign the employee to the service request
        $assignment_sql = "INSERT INTO assignments (request_id, employee_id) 
                           VALUES ('$request_id', '$employee_id')";
        
        if ($conn->query($assignment_sql) === TRUE) {
            echo "Service request and employee assignment added successfully!";
        } else {
            echo "Error in assigning employee: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service Request</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <h1>Add Service Request</h1>
    <form action="add_service_request.php" method="POST">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required><br>

        <label for="service_id">Service ID:</label>
        <input type="text" name="service_id" required><br>

        <label for="special_requests">Special Requests:</label>
        <textarea name="special_requests"></textarea><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="Pending" required><br>

        <!-- Fetch employees for dropdown -->
        <?php
        $employees_query = "SELECT id, name FROM employees";
        $employees_result = mysqli_query($conn, $employees_query);
        ?>
        <label for="employee">Assign Employee:</label>
        <select name="employee_id" required>
            <option value="">Select Employee</option>
            <?php while ($employee = mysqli_fetch_assoc($employees_result)): ?>
                <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <input type="submit" value="Add Service Request">
    </form>
</body>
</html>

<?php
$conn->close();
?>


