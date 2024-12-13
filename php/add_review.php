<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO reviews (user_id, service_id, rating, comments) 
            VALUES ('$user_id', '$service_id', '$rating', '$comments')";
    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="add_review.php">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" required><br>

    <label for="service_id">Service ID:</label>
    <input type="text" name="service_id" required><br>

    <label for="rating">Rating (1-5):</label>
    <input type="number" name="rating" min="1" max="5" required><br>

    <label for="comments">Comments:</label>
    <textarea name="comments" required></textarea><br>

    <button type="submit">Submit Review</button>
</form>
