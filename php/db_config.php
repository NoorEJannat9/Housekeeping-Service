<?php
$host = 'localhost';
$username = 'root';        // default XAMPP MySQL username
$password = '';            // default XAMPP MySQL password (empty by default)
$dbname = 'housekeeping_service'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>