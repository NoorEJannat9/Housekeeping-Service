<?php
include('db_config.php');

// Check if the ID is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM service_requests WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Service request deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
