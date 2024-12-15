<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once "../../middlewares/api-auth.php";

$database = new Database();
$db = $database->connect();

$image = new Image($db);

$result = $image->read($user_id);
$num = $result->rowCount();

if ($num > 0) {
  $images_arr = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $image_item = array(
      'id' => $id,
      'note_id' => $note_id,
      'url' => $url
    );

    array_push($images_arr, $image_item);
  }

  echo json_encode($images_arr);
} else {
  echo json_encode(array());
}