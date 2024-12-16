<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Note.php';
include_once '../../models/NoteAuth.php';
include_once "../../middlewares/api-auth.php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate note object
$note = new Note($db);
$noteAuth = new NoteAuth($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$note->title = $data->title;
$note->content = $data->content;
$note->creator_id = $user_id;

// Create note
if ($note->create()) {

  $note->id = $db->lastInsertId();
  $note->read_single();

  // Grant can_read permission to the creator
  // $noteAuth->email = $user_id;
  // $noteAuth->note_id = $note->id;
  // $noteAuth->can_read = 1;
  // $noteAuth->creator_id = $user_id;
  // $noteAuth->updatePermission();

  $note_item = array(
    'id' => $note->id,
    'title' => $note->title,
    'content' => $note->content,
    'creator_id' => $note->creator_id,
    //'creator_name' => $note->creator_name,
    'updatedAt' => $note->updated_at
  );

  echo json_encode($note_item);
} else {
  echo json_encode(
    array('message' => 'note Not Created')
  );
}