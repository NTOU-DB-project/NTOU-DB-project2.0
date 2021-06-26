<?php
// Headers
include_once '../../middlewares/origin.php';
include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
User::set_connection($db);

try {
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $user = User::get_by_email_and_password($data->email, $data->password);

    if (!$user) {
        throw new Exception("", 401);
    } else {
        echo json_encode($user->to_assoc());
    }
} catch (Exception $e) {
    if ($e->getCode() == 401) {
        $code = 401;
        $message = "Invalid email or password.";
    } else {
        $code = 500;
        $message = "Error occurred while logging in.";
    }
    http_response_code($code);
    echo json_encode(array('message' => $message));
}
