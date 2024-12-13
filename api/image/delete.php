<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
include_once "../../middlewares/api-auth.php";

$database = new Database();
$db = $database->connect();

$image = new Image($db);

$data = json_decode(file_get_contents("php://input"));

$image->id = $data->id;

if ($image->delete()) {
  echo json_encode(array('message' => 'Image Deleted'));
} else {
  echo json_encode(array('message' => 'Image Not Deleted'));
}