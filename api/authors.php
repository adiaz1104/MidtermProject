<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../config/Database.php';
include_once '../models/Author.php';

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch a single author by ID
    $query = "SELECT id, author FROM authors WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Return the specific author as JSON
        echo json_encode($row);
    } else {
        // No author found with the provided ID
        echo json_encode(array('message' => 'No author found with the given ID.'));
    }
} else {
    // Fetch all authors
    $query = "SELECT id, author FROM authors";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return all authors as JSON
    echo json_encode($authors);
}
?>