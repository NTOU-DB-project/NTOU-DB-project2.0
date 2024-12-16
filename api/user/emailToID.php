<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Database connection failed."]);
    exit;
}

// Read raw JSON input data
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email) || empty(trim($data->email))) {
    http_response_code(400);
    echo json_encode(["message" => "Email is required."]);
    exit;
}

// Sanitize and retrieve the email
$email = trim($data->email);

// Instantiate user object
$user = new User($db);

// Get user by email
$user_obj = $user->get_by_email($email);

// Check if user exists
if (!$user_obj) {
    http_response_code(404);
    echo json_encode(["message" => "User not found."]);
    exit;
}

// Return user ID as JSON
http_response_code(200);
echo json_encode(["id" => $user_obj->id]);
