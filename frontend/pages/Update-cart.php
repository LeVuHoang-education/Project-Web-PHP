<?php
session_start();
require __DIR__ . "../../../db/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    $data = file_get_contents('php://input');
    $cartItems = json_decode($data, true);

    if (is_array($cartItems)) {
        foreach ($cartItems as $item) {
            $id = $item['id'];
            $quantity = $item['quantity'];

            $sql = "UPDATE `cart-item` SET quantity = ? WHERE proID = ? AND userID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $quantity, $id, $_SESSION['user_id']);
            if (!$stmt->execute()) {
                echo json_encode(['status' => 'error', 'message' => $stmt->error]);
                exit();
            }
        }
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data format']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}