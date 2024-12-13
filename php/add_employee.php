<?php
// add_employee.php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO employees (name, email, phone, specialization, created_at) VALUES ('$name', '$email', '$phone', '$specialization', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form action="add_employee.php" method="POST">
        <label for="name">Employee Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>

        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" required><br>

        <input type="submit" value="Add Employee">
    </form>
</body>
</html>
