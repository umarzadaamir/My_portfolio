<?php
class database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = null;
    private $db_name = "my_project";
    private $conn;
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Connection error: " . $error->getMessage();
        }
        return $this->conn;
    }
}
