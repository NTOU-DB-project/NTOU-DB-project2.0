<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Note.php';
include_once '../../models/NoteAuth.php';
include_once "../../middlewares/api-auth.php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate note object
$note_auth = new NoteAuth(db: $db);
// Get raw  data
$data = json_decode(file_get_contents("php://input"));

// Set user_id to update
$note_auth->user_id = $user_id;
$note_auth->note_id = $data->id;
$note_auth->creator_id = $data->creator_id;
$note_auth->can_read = $data->can_read;
// set auth to user
if ($note_auth->checkPermission()) {
  $auth= array(
    'user_id' => $user_id,
    'note_id' => $note_auth->note_id,
    'can_read' => $note_auth->can_read,
    'creator_id' => $note->creator_id,
  );
  // Turn to JSON & output
  echo json_encode($auth);
} else {
  echo json_encode(
    array('message' => 'auth not grant')
  );
}
