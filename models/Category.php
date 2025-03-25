<?php
class Category {
    private $conn;
    private $table = 'categories'; // Table name

    // Category properties
    public $id;
    public $category;

    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to retrieve all categories
    public function read() {
        $query = "SELECT id, category FROM " . $this->table . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>