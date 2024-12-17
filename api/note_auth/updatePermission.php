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
$note_auth = new NoteAuth(db: $db);
// Get raw  data
$data = json_decode(file_get_contents("php://input"));

// Set user_id to update
$note_auth->user_id = $data->user_id;
$note_auth->note_id = $data->note_id;
$note_auth->can_read = $data->can_read;
$note_auth->creator_id = $data->creator_id;
$note_auth->updatePermission();