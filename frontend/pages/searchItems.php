<?php
session_start();
require_once "../../db/connect.php";

if (isset($_POST['search-item'])) {
    $_SESSION['keySearch'] = $_POST['search-item'];
    $key_searching[] = "% " . $_POST['search-item'] . " %";
    $key_searching[] = $_POST['search-item'] . " %";
    $key_searching[] = "% " . $_POST["search-item"] . "%";
    $sql = "SELECT * FROM `product` WHERE UPPER(proname) LIKE UPPER('$key_searching[0]') 
    OR UPPER(proname) LIKE  UPPER('$key_seaching[1]')
    OR UPPER(proname) LIKE  UPPER('$key_searching[2]')";
    $listProduct = $conn->query($sql);

    $list = [];
    while ($row = $listProduct->fetch_assoc()) {
        $list[] = $row['proid'];
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
if (isset($_POST['min-range']) && isset($_POST['max-range']) && $_POST['key_search']) {
    $minValue = $_POST['min-range'];
    $maxValue = $_POST['max-range'];

    $key_searching[] = "% " . $_POST['key_search'] . " %";
    $key_searching[] = $_POST['key_search'] . " %";
    $key_searching[] = "% " . $_POST["key_search"] . "%";
    $sql = "SELECT * FROM `product` WHERE UPPER(proname) LIKE UPPER('$key_searching[0]') 
    OR UPPER(proname) LIKE  UPPER('$key_seaching[1]')
    OR UPPER(proname) LIKE  UPPER('$key_searching[2]')";
    $listProduct = $conn->query($sql);

    while ($row = $listProduct->fetch_assoc()) {
        if ($row['proprice'] >= $minValue && $row['proprice'] <= $maxValue) {
            $newList[] = $row['proid'];
        }
    }
    unset($_SESSION['itemList']);
    $_SESSION['itemList'] = [];

    foreach ($newList as $itemId) {
        $_SESSION['itemList'][] = $itemId;
    }
    $_SESSION['minValue'] = $minValue;
    $_SESSION['maxValue'] = $maxValue;
    header("Location: ../../index.php?act=search");

}
