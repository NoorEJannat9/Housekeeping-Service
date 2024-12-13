<?php
include('db_config.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch filtered records
$sql = "SELECT * FROM service_requests WHERE status LIKE '%$search%'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo $row['id'] . " - " . $row['status'] . "<br>";
}
?>

<form method="GET" action="search_service_requests.php">
    <input type="text" name="search" placeholder="Search by status" value="<?= $search ?>">
    <button type="submit">Search</button>
</form>
