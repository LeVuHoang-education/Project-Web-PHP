<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "../../../../../frontend/pages/Function.php";

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['prodID'];

foreach ($_SESSION['lovelist'] as $key => $value) {
    if ($value == $productId) {
        unset($_SESSION['lovelist'][$key]);
        break;
    }
}
$response = [
    'message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích', // Adjust message as needed
];
header('Content-Type: application/json');

echo json_encode($response);
