<?php
class Note
{

  private $conn;
  private $table = 'notes';

  // note Properties
  public $id;
  public $creator_id;
  public $title;
  public $content;
  public $updated_at;
  public $creator_name;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

// Get notes
  public function read($user_id)
  {

    $query = 'SELECT u.name as creator_name, n.id, n.creator_id, n.title, n.content, n.updated_at
            FROM ' . $this->table . ' n
            LEFT JOIN
              users u ON n.creator_id = u.id
            WHERE
              n.creator_id = ? 
              OR n.id IN (
                  SELECT note_id 
                  FROM note_auths 
                  WHERE user_id = ?
                  AND can_read = 1
              )';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $user_id);
    $stmt->bindParam(2, $user_id);
    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Note
  public function read_single()
  {
    // Create query
    $query = 'SELECT u.name as creator_name, n.id, n.creator_id, n.title, n.content, n.updated_at
              FROM ' . $this->table . ' n
              LEFT JOIN
                users u ON n.creator_id = u.id
              WHERE
                n.id = ?
              LIMIT 0,1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->creator_id = $row['creator_id'];
    $this->title = $row['title'];
    $this->content = htmlspecialchars_decode($row['content']);
    $this->updated_at = $row['updated_at'];
    $this->creator_name = $row['creator_name'];
  }

  // Create Note
  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET title = :title, content = :content, creator_id = :creator_id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->content = htmlspecialchars($this->content);
    $this->creator_id = htmlspecialchars(strip_tags($this->creator_id));

    // Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':content', $this->content);
    $stmt->bindParam(':creator_id', $this->creator_id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update Note
  public function update()
  {
    // Create query
    $query = 'UPDATE ' . $this->table . '
              SET content = :content
              WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->content = htmlspecialchars($this->content);
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':content', $this->content);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Delete Note
  public function delete()
  {
    // Delete related note_auths records
    $query = 'DELETE FROM note_auths WHERE note_id = :note_id';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':note_id', $this->id);
    $stmt->execute();

    // Delete the note
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }

    // Log error for debugging
    error_log("Error executing query: " . $stmt->errorInfo());

    return false;
  }

  public function search($search_term)
  {
    $query = 'SELECT u.name as creator_name, n.id, n.creator_id, n.title, n.content, n.updated_at
    FROM ' . $this->table . '  n
    LEFT JOIN users u ON n.creator_id = u.id
    WHERE n.title LIKE ? ';

    $stmt = $this->conn->prepare($query);

    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    // $stmt->bindParam(2, $search_term);

    $stmt->execute();

    return $stmt;
  }
  public function count_notes($user_id)
  {
      $query = 'SELECT COUNT(*) as total_notes FROM ' . $this->table . ' WHERE creator_id = ?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind parameter
      $stmt->bindParam(1, $user_id);

      // Execute query
      $stmt->execute();

      // Fetch the result
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Return the count
      return $row['total_notes'] ?? 0;
  }

}
