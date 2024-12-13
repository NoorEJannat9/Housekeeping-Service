<?php
include('db_config.php');

// Get the service request to be updated
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM service_requests WHERE id = '$id'";
    $result = $conn->query($sql);
    $service_request = $result->fetch_assoc();
}
?>

<form method="post" action="update_service_request_process.php">
    <input type="hidden" name="id" value="<?= $service_request['id'] ?>">
    <label for="user_id">User ID</label>
    <input type="text" name="user_id" value="<?= $service_request['user_id'] ?>" required>
    
    <label for="service_id">Service ID</label>
    <input type="text" name="service_id" value="<?= $service_request['service_id'] ?>" required>
    
    <label for="special_requests">Special Requests</label>
    <textarea name="special_requests"><?= $service_request['special_requests'] ?></textarea>
    
    <label for="status">Status</label>
    <select name="status">
        <option value="Pending" <?= ($service_request['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
        <option value="In Progress" <?= ($service_request['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
        <option value="Completed" <?= ($service_request['status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
    </select>

    <button type="submit">Update</button>
</form>




