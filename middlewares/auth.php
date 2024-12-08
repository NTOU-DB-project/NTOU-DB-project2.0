<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: php-simple-note-app/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
