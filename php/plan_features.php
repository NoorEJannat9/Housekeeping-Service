<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plan_id = $_POST['plan_id'];
    $feature_name = $_POST['feature_name'];

    $sql = "INSERT INTO plan_features (plan_id, feature_name) 
            VALUES ('$plan_id', '$feature_name')";
    if ($conn->query($sql) === TRUE) {
        echo "Feature added to plan successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="plan_features.php">
    <label for="plan_id">Select Plan:</label>
    <select name="plan_id" required>
        <?php
        $plans_query = "SELECT id, plan_name FROM plans";
        $plans_result = mysqli_query($conn, $plans_query);
        while ($plan = mysqli_fetch_assoc($plans_result)) {
            echo "<option value='{$plan['id']}'>{$plan['plan_name']}</option>";
        }
        ?>
    </select><br>

    <label for="feature_name">Feature Name:</label>
    <input type="text" name="feature_name" required><br>

    <button type="submit">Add Feature</button>
</form>
