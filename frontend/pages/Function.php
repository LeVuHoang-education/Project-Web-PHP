<?php
require __DIR__ . '../../../db/connect.php';
function getOrder()
{
    global $conn;
    $getOD_sql = "SELECT * FROM orders order by orderid";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getOrderbyID($id)
{
    global $conn;
    $getOD_sql = "SELECT * FROM orders where orderid = $id";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getCartbyID($id)
{
    global $conn;
    $getOD_sql = "SELECT * FROM `orders` WHERE userid = $id and status = 'Đang chờ xử lí'";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getItembyID($id)
{
    global $conn;
    $getItem_sql  = "SELECT * FROM orders_item where orderid = $id";
    $result = $conn->query($getItem_sql);
    return $result;
}
function getProductbyID($id)
{
    global $conn;
    $getProduct_sql = "SELECT * FROM product where proid = $id";
    $result = $conn->query($getProduct_sql);
    return $result;
}
define('ENCRYPTION_KEY', 'your-secret-key-here');
//ma hoa du lieu (tk ngan hang)
function encryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}
//giai ma du lieu (tk ngan hang)
function decryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY);
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}
//lay stk nh
function getNhbyID($id)
{
    global $conn;
    $getAccountBank_sql = "SELECT * FROM account_bank where id = $id";
    $result = $conn->query($getAccountBank_sql);
    return  $result;
}
//lay address cua khach hang
function getAddressbyID($id)
{
    global $conn;
    $getAddress_sql = "SELECT * FROM address where id = $id";
    $result = $conn->query($getAddress_sql);
    return $result;
}
function getUserbyID($id)
{
    global $conn;
    $getPassword_sql = "SELECT * FROM account where id = $id";
    $result = $conn->query($getPassword_sql);
    return $result;
}

function fetchDataFromAPi($url)
{
    $curl = curl_init();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $data = json_decode($result, true);
    } else {
        echo "API không còn hoạt động hoặc không truy cập được. Mã HTTP: $httpCode";
    }
    return $data;
}

function themItemCart($userID, $proID, $quantity, $price)
{
    global $conn;
    $sql = "INSERT INTO `cart-item` (userID, proID, quantity, itemprice) VALUES ( ? , ? , ? , ? )";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SQL: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("iiii", $userID, $proID, $quantity, $price);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
}
function updateQuantityItemCart($userID, $proID, $quantity)
{
    global $conn;
    $sql = "UPDATE `cart-item` SET quantity = ? WHERE userID = ? and proID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $userID, $proID);
    $stmt->execute();
    $stmt->close();
}
function delItemCart($userID, $proID)
{
    global $conn;
    $sql = "DELETE FROM `cart-item` WHERE userID = ? and proID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userID, $proID);
    $stmt->execute();
    $stmt->close();
}
function delAllItemCart($userID)
{
    global $conn;
    $sql = "DELETE FROM `cart-item` WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->close();
}
function getAllItemCart($userID)
{
    global $conn;
    $sql = "SELECT `cart-item`.*, product.image_path, product.proname FROM `cart-item` INNER JOIN product ON `cart-item`.proID = product.proid WHERE `cart-item`.userID = ? ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SQL: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $userID);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }

    return $result;
}
