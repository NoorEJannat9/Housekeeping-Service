<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $duration = $_POST['duration']; // Duration in months

    $sql = "INSERT INTO plans (plan_name, price, duration) 
            VALUES ('$plan_name', '$price', '$duration')";
    if ($conn->query($sql) === TRUE) {
        echo "Plan added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="add_plan.php">
    <label for="plan_name">Plan Name:</label>
    <input type="text" name="plan_name" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br>

    <label for="duration">Duration (months):</label>
    <input type="number" name="duration" required><br>

    <button type="submit">Add Plan</button>
</form>
