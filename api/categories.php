<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Category.php';

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch a single category by ID
    $query = "SELECT id, category FROM categories WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Return the specific category as JSON
        echo json_encode($row);
    } else {
        // No category found with the provided ID
        echo json_encode(array('message' => 'No category found with the given ID.'));
    }
} else {
    // Fetch all categories
    $query = "SELECT id, category FROM categories";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return all categories as JSON
    echo json_encode($categories);
}
?>