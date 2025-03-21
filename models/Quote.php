<?php
// Quote model class for interacting with the quotes table
class Quote {
    private $conn;
    private $table = 'quotes'; // Table name

    // Quote attributes
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to retrieve all quotes
    public function readAll() {
        // SQL query to fetch all quotes with author and category
        $query = "SELECT q.id, q.quote, a.author, c.category
                  FROM $this->table q
                  JOIN authors a ON q.author_id = a.id
                  JOIN categories c ON q.category_id = c.id";
        $stmt = $this->conn->prepare($query); // Prepare the query
        $stmt->execute(); // Execute the query
        return $stmt; // Return the statement
    }

    // Method to retrieve a single quote by ID
    public function readSingle($id) {
        $query = "SELECT q.id, q.quote, a.author, c.category
                  FROM $this->table q
                  JOIN authors a ON q.author_id = a.id
                  JOIN categories c ON q.category_id = c.id
                  WHERE q.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id); // Bind the ID parameter
        $stmt->execute();
        return $stmt;
    }

    // Additional CRUD methods (create, update, delete) can be added here
}
?>
