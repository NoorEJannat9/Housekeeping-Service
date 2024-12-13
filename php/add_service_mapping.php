<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO service_mappings (service_id, category_id) 
            VALUES ('$service_id', '$category_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Service mapped to category successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="add_service_mapping.php">
    <label for="service_id">Select Service:</label>
    <select name="service_id" required>
        <?php
        $services_query = "SELECT id, service_name FROM services";
        $services_result = mysqli_query($conn, $services_query);
        while ($service = mysqli_fetch_assoc($services_result)) {
            echo "<option value='{$service['id']}'>{$service['service_name']}</option>";
        }
        ?>
    </select><br>

    <label for="category_id">Select Category:</label>
    <select name="category_id" required>
        <?php
        $categories_query = "SELECT id, category_name FROM service_categories";
        $categories_result = mysqli_query($conn, $categories_query);
        while ($category = mysqli_fetch_assoc($categories_result)) {
            echo "<option value='{$category['id']}'>{$category['category_name']}</option>";
        }
        ?>
    </select><br>

    <button type="submit">Map Service</button>
</form>
