<?php
include_once __DIR__ . '/../config/database.php';

// Create a Database instance and test the connection
$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed!";
}
?>