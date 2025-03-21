<?php
// Set the response to JSON format
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../models/Category.php';

// Instantiate the Database and Category objects
$database = new Database();
$db = $database->connect();
$category = new Category($db);

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Fetch a specific category by ID
        $stmt = $category->readSingle($_GET['id']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode($row); // Return the category as JSON
        } else {
            echo json_encode(["message" => "category_id Not Found"]); // Error if ID not found
        }
    } else {
        // Fetch all categories
        $stmt = $category->readAll();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($categories); // Return all categories as JSON
    }
} else {
    echo json_encode(["message" => "Invalid Request Method"]);
}
?>
