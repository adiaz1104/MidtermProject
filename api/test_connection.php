<?php
include_once __DIR__ . '/../config/Database.php';

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed!";
}
?>