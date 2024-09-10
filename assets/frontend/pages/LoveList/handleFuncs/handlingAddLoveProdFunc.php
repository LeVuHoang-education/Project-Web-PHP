<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../../../../../db/connect.php";

function addLoveProduct($id) {}
function removeLoveProduct($id) {}

//doc du lieu tu json
$data = json_decode(file_get_contents('php://input'), true);
$productID = $data['prodID'];

//khoi tao session
if (!isset($_SESSION['product_list'])) {
    $_SESSION['product_list'] = [];
};

//them san phan vao session neu khong co trong danh sach
if (!in_array($productID, $_SESSION['product_list'])) {
    array_push($_SESSION['product_list'], $productID);
    $response = ['message' => 'add',];
} else {
    foreach ($_SESSION['product_list'] as $key => $value) {
        if ($value == $productID) {
            unset($_SESSION['product_list'][$key]);
            $response = ['message' => 'remove',];
            break;
        }
    }
}

header('Content-Type: application/json');

echo json_encode($response);
