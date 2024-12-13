<?php
include('db_config.php');

$query = "SELECT * FROM offers WHERE valid_until >= CURDATE()"; 
$result = mysqli_query($conn, $query);
?>

<h1>Current Offers</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Discount</th>
            <th>Valid Until</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($offer = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($offer['offer_title']) ?></td>
            <td><?= htmlspecialchars($offer['description']) ?></td>
            <td><?= htmlspecialchars($offer['discount_percentage']) ?>%</td>
            <td><?= htmlspecialchars($offer['valid_until']) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
