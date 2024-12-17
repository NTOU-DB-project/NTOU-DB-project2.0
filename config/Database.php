<?php
class Database
{
  private $conn;

  // DB Connect
  public function connect()
  {

    $config = include(__DIR__ . '/config.php');



    try {
      $this->conn = new PDO(
        'mysql:host=' . $config['db_host'] .
          ';port=' . $config['db_port'] .
          ';dbname=' . $config['db_name'],
        $config['db_username'],
        $config['db_password']
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
