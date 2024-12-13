<?php
class NoteAuth
{
    private $conn;
    private $table = 'note_auths';

    // Note properties
    public $user_id;
    public $note_id;
    public $can_read;
    public $can_write;
    public $creator_id;

    // Constructor with DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Check permissions for a user on a specific note
    public function checkPermission()
    {
        // SQL query to check read/write permissions
        $query = 'SELECT can_read, can_write 
                  FROM' . $this->table . ' 
                  WHERE user_id = :user_id AND note_id = :note_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':note_id', $this->note_id);

        // Execute query
        $stmt->execute();

        // Return the result
        return $stmt;
    }

    // Grant or update permissions for a user on a note
    public function updatePermission()
    {
        // SQL query to insert or update permissions
        $query = 'INSERT INTO' . $this->table . ' (user_id, note_id, can_read, can_write, creator_id)
                  VALUES (:user_id, :note_id, :can_read, :can_write, :creator_id)
                  ON DUPLICATE KEY UPDATE 
                  can_read = :can_read, 
                  can_write = :can_write';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':note_id', $this->note_id);
        $stmt->bindParam(':can_read', $this->can_read, PDO::PARAM_BOOL);
        $stmt->bindParam(':can_write', $this->can_write, PDO::PARAM_BOOL);
        $stmt->bindParam(':creator_id', $this->creator_id);

        // Execute query
        return $stmt->execute();
    }
}
