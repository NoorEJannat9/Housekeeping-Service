<?php
// add_schedule.php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO schedules (employee_id, date, start_time, end_time) 
            VALUES ('$employee_id', '$date', '$start_time', '$end_time')";

    if ($conn->query($sql) === TRUE) {
        echo "Schedule added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Schedule</title>
</head>
<body>
    <h1>Add Schedule</h1>
    <form action="add_schedule.php" method="POST">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" required><br>

        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" required><br>

        <input type="submit" value="Add Schedule">
    </form>
</body>
</html>
