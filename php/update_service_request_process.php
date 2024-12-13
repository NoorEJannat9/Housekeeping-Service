<?php
include('db_config.php');

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $special_requests = $_POST['special_requests'];
    $status = $_POST['status'];

    // Update the service request
    $update_sql = "UPDATE service_requests SET user_id = '$user_id', service_id = '$service_id', special_requests = '$special_requests', status = '$status' WHERE id = '$id'";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "Service request updated successfully!";

        // Generate invoice if status is 'Completed'
        if ($status == 'Completed') {
            // Calculate total amount for the service request
            $total_amount_query = "SELECT SUM(price) AS total_amount 
                                   FROM services s
                                   JOIN service_requests sr ON sr.service_id = s.id
                                   WHERE sr.id = '$id'";
            $total_amount_result = mysqli_query($conn, $total_amount_query);
            $total_amount = mysqli_fetch_assoc($total_amount_result)['total_amount'];

            // Insert the invoice into the database
            $invoice_sql = "INSERT INTO invoices (request_id, total_amount) VALUES ('$id', '$total_amount')";
            if ($conn->query($invoice_sql) === TRUE) {
                echo " Invoice generated successfully!";
            } else {
                echo "Error generating invoice: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error updating service request: " . mysqli_error($conn);
    }
}

$conn->close();
?>
