<?php
$host = 'localhost';  // Database host
$user = 'root';       // Database username
$password = '';       // Database password
$dbname = 'user_db';  // Database name

// Create a MySQLi connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character set to utf8
$conn->set_charset("utf8");

// Don't close the connection here; let the calling script do it
?>
