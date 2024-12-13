// Fetch invoices for the logged-in user
$query = "SELECT i.id, i.total_amount, i.generated_at, sr.id AS request_id 
          FROM invoices i
          JOIN service_requests sr ON i.request_id = sr.id
          WHERE sr.user_id = $user_id";
$result = mysqli_query($conn, $query);

<h1>Your Invoices</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Request ID</th>
        <th>Total Amount</th>
        <th>Generated At</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['request_id'] ?></td>
            <td><?= $row['total_amount'] ?></td>
            <td><?= $row['generated_at'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
