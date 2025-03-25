<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Quote.php';

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch a single quote by ID
    $query = "SELECT id, quote, author_id, category_id FROM quotes WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Return the specific quote as JSON
        echo json_encode($row);
    } else {
        // No quote found with the provided ID
        echo json_encode(array('message' => 'No quote found with the given ID.'));
    }
} else {
    // Fetch all quotes
    $query = "SELECT id, quote, author_id, category_id FROM quotes";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return all quotes as JSON
    echo json_encode($quotes);
}
?>