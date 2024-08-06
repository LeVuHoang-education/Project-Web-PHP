<?php
require('../../db/connect.php');
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

?>