<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) {
    $response = [
        'message' => 'notallow',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = [
        'message' => 'allow',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
