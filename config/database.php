<?php
/*/ Class for handling database connection
class Database {
    // Database parameters
    private $host = 'dpg-cveb1hbv2p9s73dl67ng-a.virginia-postgres.render.com';
    private $db_name = 'quotesdb_kxfx';
    private $username = 'quotesdb_kxfx_user'; 
    private $password = 'OreCYVoRpY8pgAQzbQ8gbIOA5BJsZT5U';
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

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "Database connection successful!";
} else {
    echo "Connection failed.";
}
    */


class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Fetch connection details from environment variables
        $this->host = getenv('DB_HOST');
        $this->db_name = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
    }

    public function connect() {
        $this->conn = null;

        try {
            // Create database connection using PDO
            $this->conn = new PDO("pgsql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>