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
    $user = User::create_user($data->name, $data->email, $data->password);

    if (!$user) {
        throw new Exception();
    } else {
        echo json_encode($user->to_assoc());
        session_start();
        $_SESSION['user_id'] = $user->id;
    }
} catch (Exception $e) {
    // Duplicate entry error code
    if ($e->getCode() == 23000) {
        $code = 401;
        $message = "This e-mail is already used.";
    } else {
        $code = 500;
        $message = "Sorry, some errors occurred while creating account.";
    }
    http_response_code($code);
    echo json_encode(array('message' => $message));
}
