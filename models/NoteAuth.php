<?php
class NoteAuth
{
    private $conn;
    private $table = 'note_auths';

    // Note properties
    public $user_id;
    public $note_id;
    public $can_read;
    public $creator_id;

    // Constructor with DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Check permissions for a user on a specific note
    public function checkPermission()
    {
        // SQL query to check read permissions
        $query = 'SELECT can_read
                  FROM ' . $this->table . ' 
                  WHERE user_id = :user_id AND note_id = :note_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':note_id', $this->note_id);

        // Execute query
        $stmt->execute();

        error_log("Executed Query: " . $stmt->queryString);

        // Return the result
        return $stmt;
    }
}