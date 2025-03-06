<?php
// Database configuration
$host = 'localhost'; // Usually 'localhost'
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'BGC_database'; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>