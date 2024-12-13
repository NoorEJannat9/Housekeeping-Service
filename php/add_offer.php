<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_title = $_POST['offer_title'];
    $description = $_POST['description'];
    $discount_percentage = $_POST['discount_percentage'];
    $valid_from = $_POST['valid_from'];
    $valid_until = $_POST['valid_until'];

    $sql = "INSERT INTO offers (offer_title, description, discount_percentage, valid_from, valid_until) 
            VALUES ('$offer_title', '$description', '$discount_percentage', '$valid_from', '$valid_until')";
    if ($conn->query($sql) === TRUE) {
        echo "Offer added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="add_offer.php">
    <label for="offer_title">Offer Title:</label>
    <input type="text" name="offer_title" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="discount_percentage">Discount Percentage:</label>
    <input type="number" name="discount_percentage" min="0" max="100" required><br>

    <label for="valid_from">Valid From:</label>
    <input type="date" name="valid_from" required><br>

    <label for="valid_until">Valid Until:</label>
    <input type="date" name="valid_until" required><br>

    <button type="submit">Add Offer</button>
</form>
