<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'note_app';
    private $username = 'root';
    private $password = 'elena198919';
    private $port = '3307'; 
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';port='.$this->port.';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }