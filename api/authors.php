<?php
// Set the response to JSON format
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../models/Author.php';

// Instantiate the Database and Author objects
$database = new Database();
$db = $database->connect();
$author = new Author($db);

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Fetch a specific author by ID
        $stmt = $author->readSingle($_GET['id']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode($row); // Return the author as JSON
        } else {
            echo json_encode(["message" => "author_id Not Found"]); // Error if ID not found
        }
    } else {
        // Fetch all authors
        $stmt = $author->readAll();
        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($authors); // Return all authors as JSON
    }
} else {
    echo json_encode(["message" => "Invalid Request Method"]);
}
?>

