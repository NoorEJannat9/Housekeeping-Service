<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_request_id = $_POST['service_request_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status']; 

    $sql = "INSERT INTO payments (service_request_id, amount, payment_method, payment_status) 
            VALUES ('$service_request_id', '$amount', '$payment_method', '$payment_status')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment recorded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="add_payment.php">
    <label for="service_request_id">Service Request ID:</label>
    <input type="text" name="service_request_id" required><br>

    <label for="amount">Amount:</label>
    <input type="number" name="amount" required><br>

    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" required>
        <option value="Credit Card">Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Bank Transfer">Bank Transfer</option>
    </select><br>

    <label for="payment_status">Payment Status:</label>
    <select name="payment_status" required>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select><br>

    <button type="submit">Record Payment</button>
</form>
