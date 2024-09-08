<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "../../../../../frontend/pages/Function.php";
//ktra gio hang co ton tai ch
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['dataiGH'])) {
    $_SESSION['dataiGH'] = false;
}
if (isset($_SESSION['user_id']) && $_SESSION['dataiGH'] == false) {
    $cartData = getAllItemCart($_SESSION['user_id']);
    while ($row = $cartData->fetch_assoc()) {
        $idsp = $row['proID'];
        $name = $row['proname'];

        if ($row['sales'] == null) {
            $price = $row['itemprice'];
        } else {
            $price = $row['itemprice'] * (1 - $row['sales'] / 100);
        }
        $img = $row['image_path'];
        $quantity = $row['quantity'];

        $sp = [$idsp, $name, $quantity, $price, $img];
        $_SESSION['cart'][] = $sp;
    }
    $_SESSION['dataiGH'] = true;
}
//lay data tu form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idsp = $_POST['idSP'];
    $name = $_POST['nameSP'];
    $price = $_POST['priceSP'];
    $img = $_POST['imgSP'];
    $quantity = 1;
    $mua = $_POST['mua'];

    if ($mua == '0') {
        $is_exist = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item[0] == $idsp) {
                $is_exist = true;
                $item[2]++;
                if (isset($_SESSION['user_id'])) {
                    updateQuantityItemCart($_SESSION['user_id'], $idsp, $item[2]);
                }
                break;
            }
        }
        if (!$is_exist) {
            $sp = [$idsp, $name, $quantity, $price, $img, $mua];
            $_SESSION['cart'][] = $sp;
            if (isset($_SESSION['user_id'])) {
                themItemCart($_SESSION['user_id'], $idsp, $quantity, $price);
            }
        }
    }
    echo 'OK';
}
