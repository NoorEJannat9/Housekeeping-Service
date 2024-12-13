<?php
// Include database connection
include('db_config.php');

// Assuming service_id is passed in the URL
$service_id = $_GET['service_id'];

// Fetch service details (optional if you want to show service information along with feedback)
$service_query = "SELECT name, description FROM services WHERE id = $service_id";
$service_result = mysqli_query($conn, $service_query);
$service = mysqli_fetch_assoc($service_result);

// Fetch feedback for the service
$feedback_query = "SELECT u.username, f.rating, f.comments, f.created_at 
                   FROM feedback f
                   JOIN users u ON f.user_id = u.id
                   WHERE f.service_id = $service_id";
$feedback_result = mysqli_query($conn, $feedback_query);
?>

<h2><?= htmlspecialchars($service['name']) ?> - Service Feedback</h2>
<p><?= htmlspecialchars($service['description']) ?></p>

<h3>Feedback</h3>
<?php while ($feedback = mysqli_fetch_assoc($feedback_result)): ?>
    <p><strong><?= htmlspecialchars($feedback['username']) ?>:</strong> <?= htmlspecialchars($feedback['comments']) ?> 
    (Rating: <?= htmlspecialchars($feedback['rating']) ?>/5)</p>
    <p><em>Submitted on: <?= htmlspecialchars($feedback['created_at']) ?></em></p>
<?php endwhile; ?>

<h3>Submit Your Feedback</h3>
<form method="POST" action="add_feedback.php">
    <label for="rating">Rating (1-5):</label>
    <input type="number" name="rating" min="1" max="5" required>
    
    <label for="comments">Comments:</label>
    <textarea name="comments" rows="4"></textarea>
    
    <input type="hidden" name="service_id" value="<?= $service_id ?>">
    <button type="submit">Submit Feedback</button>
</form>

<?php
$conn->close();
?>

