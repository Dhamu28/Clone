<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$pwd = '';
$database  = 'library';

// Create connection
$conn = mysqli_connect($host, $user, $pwd, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
