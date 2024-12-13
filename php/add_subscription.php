<?php
// add_subscription.php
include('db_config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $plan_id = mysqli_real_escape_string($conn, $_POST['plan_id']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    // Insert the subscription record into the database
    $sql = "INSERT INTO subscriptions (user_id, plan_id, start_date, end_date) 
            VALUES ('$user_id', '$plan_id', '$start_date', '$end_date')";

    // Execute query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "<p>Subscription added successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subscription</title>
</head>
<body>
    <h1>Add Subscription</h1>
    
    <form action="add_subscription.php" method="POST">
        <!-- User ID Input -->
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required><br>

        <!-- Plan Selection Dropdown -->
        <label for="plan_id">Plan:</label>
        <select name="plan_id" required>
            <option value="">Select a Plan</option>
            <?php
            // Fetch available plans from the database
            $plans_query = "SELECT id, plan_name FROM plans";
            $plans_result = mysqli_query($conn, $plans_query);
            
            if (mysqli_num_rows($plans_result) > 0) {
                // Display all available plans in the dropdown
                while ($plan = mysqli_fetch_assoc($plans_result)) {
                    echo "<option value='{$plan['id']}'>{$plan['plan_name']}</option>";
                }
            } else {
                echo "<option value=''>No plans available</option>";
            }
            ?>
        </select><br>

        <!-- Start Date Input -->
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required><br>

        <!-- End Date Input -->
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required><br>

        <!-- Submit Button -->
        <input type="submit" value="Add Subscription">
    </form>
</body>
</html>
