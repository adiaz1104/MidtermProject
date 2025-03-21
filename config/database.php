<?php
// Class for handling database connection
class Database {
    // Database parameters
    private $host = 'YOUR_HOST'; // Replace with your Render database host
    private $db_name = 'quotesdb'; // Database name
    private $username = 'YOUR_USERNAME'; // Replace with Render-provided username
    private $password = 'YOUR_PASSWORD'; // Replace with Render-provided password
    private $conn;

    // Method to connect to the database
    public function connect() {
        $this->conn = null;

        try {
            // Using PDO for database connection
            $this->conn = new PDO("pgsql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Catch and display connection error
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn; // Return the database connection
    }
}
?>
