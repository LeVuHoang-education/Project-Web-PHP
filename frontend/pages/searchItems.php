<?php
session_start();
require_once "../../db/connect.php";

if (isset($_POST['search-item'])) {
    $_SESSION['keySearch'] = $_POST['search-item'];
    $key_searching = $_POST['search-item'];
    $sql = "SELECT * FROM `product` WHERE UPPER(proname) LIKE UPPER('%$key_searching%');";
    $listProduct = $conn->query($sql);

    $list = [];
    while ($row = $listProduct->fetch_assoc()) {
        if (strpos($row["proname"], $key_searching) !== false) {
            $list[] = $row['proid'];
        }
    }

    if (isset($_SESSION['itemList'])) {
        unset($_SESSION['itemList']);
        $_SESSION['itemList'] = [];
    } else   $_SESSION['itemList'] = [];

    foreach ($list as $itemId) {
        $_SESSION['itemList'][] = $itemId;
    }

    $conn->close();
    header("Location: ../../index.php?act=search");
}
