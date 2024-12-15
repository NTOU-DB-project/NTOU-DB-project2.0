<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once "../../middlewares/api-auth.php";

$database = new Database();
$db = $database->connect();

$image = new Image($db);

$data = json_decode(file_get_contents("php://input"));

$image->id = $data->id;
$image->url = $data->url;

if ($image->update()) {
  echo json_encode(array('message' => 'Image Updated'));
} else {
  echo json_encode(array('message' => 'Image Not Updated'));
}