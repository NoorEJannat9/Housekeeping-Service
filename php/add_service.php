<?php
// add_service.php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO services (name, description, price, duration, created_at) VALUES ('$name', '$description', '$price', '$duration', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo "New service added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
</head>
<body>
    <h1>Add Service</h1>
    <form action="add_service.php" method="POST">
        <label for="name">Service Name:</label>
        <input type="text" name="name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" required><br>

        <label for="duration">Duration:</label>
        <input type="text" name="duration" required><br>

        <input type="submit" value="Add Service">
    </form>
</body>
</html>
