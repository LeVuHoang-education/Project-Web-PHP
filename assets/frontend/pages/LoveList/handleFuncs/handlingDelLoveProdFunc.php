<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../../../../../db/connect.php";

function delLoveProduct($id)
{
    global $conn;
    $sql = "DELETE FROM `love-list` where proid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['prodID'];

foreach ($_SESSION['lovelist'] as $key => $value) {
    if ($value == $productId) {
        unset($_SESSION['lovelist'][$key]);
        break;
    }
}
if (delLoveProduct($productId)) {
    // Prepare response as JSON
    $response = [
        'message' => 'success', // Adjust message as needed
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    $response = [
        'error' => 'Cannot delete the love product from database', // Adjust message as needed
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
