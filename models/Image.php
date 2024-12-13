<?php

class Image {
  private $conn;
  private $table = 'image';

  public $id;
  public $note_id;
  public $url;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' SET note_id = :note_id, url = :url';
    $stmt = $this->conn->prepare($query);

    $this->note_id = htmlspecialchars(strip_tags($this->note_id));
    $this->url = htmlspecialchars(strip_tags($this->url));

    $stmt->bindParam(':note_id', $this->note_id);
    $stmt->bindParam(':url', $this->url);

    if ($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  public function read($user_id) {
    $query = 'SELECT i.id, i.note_id, i.url
              FROM ' . $this->table . ' i
              LEFT JOIN notes n ON i.note_id = n.id
              WHERE n.creator_id = ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    return $stmt;
  }

  public function update() {
    $query = 'UPDATE ' . $this->table . ' SET url = :url WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->url = htmlspecialchars(strip_tags($this->url));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
  }
}