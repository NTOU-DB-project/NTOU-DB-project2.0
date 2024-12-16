<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/php/logs/php_error_log');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Note.php';
include_once '../../models/NoteAuth.php';
include_once "../../middlewares/api-auth.php";

$database = new Database();
$db = $database->connect();

$notes = new Note($db);
$noteAuth = new NoteAuth($db);

$search_term = isset($_GET['query']) ? $_GET['query'] : '';

$result = $notes->search($search_term);
$num = $result->rowCount();

if ($num > 0) {
  $notes_arr = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    // Check if the user has permission to read the note
    $noteAuth->user_id = $user_id;
    $noteAuth->note_id = $id;
    $permission = $noteAuth->checkPermission()->fetch(PDO::FETCH_ASSOC);

    // Log permission for debugging
    error_log("Checking permission for user_id: $user_id, note_id: $id");
    error_log("Permission: " . json_encode($permission));

    if ($permission && $permission['can_read']) {
      $notes_item = array(
        'id' => $id,
        'title' => $title,
        'content' => htmlspecialchars_decode($content),
        'creator_id' => $creator_id,
        'updated_at' => $updated_at
      );

      array_push($notes_arr, $notes_item);
    } else {
      error_log("No read permission for user_id: $user_id, note_id: $id");
    }
  }

  echo json_encode($notes_arr);
} else {
  echo json_encode(array());
}