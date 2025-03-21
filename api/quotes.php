<?php
// Set the response to JSON format
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../models/Quote.php';

$database = new Database(); // Instantiate Database class
$db = $database->connect(); // Get database connection
$quote = new Quote($db); // Instantiate Quote model

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // If a specific ID is requested
        $stmt = $quote->readSingle($_GET['id']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode($row); // Return the specific quote as JSON
        } else {
            echo json_encode(["message" => "No Quotes Found"]);
        }
    } else {
        // If no specific ID is requested, return all quotes
        $stmt = $quote->readAll();
        $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($quotes); // Return all quotes as JSON
    }
} else {
    echo json_encode(["message" => "Invalid Request Method"]);
}
?>
