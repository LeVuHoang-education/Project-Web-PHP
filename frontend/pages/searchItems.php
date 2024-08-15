<?php
session_start();
require_once "../../db/connect.php";
include "./frontend/global/variable.php";

if (isset($_POST['search-btn'])) {
    $sql = "SELECT * FROM `product`";
    $listProduct = $conn->query($sql);
    while ($row = $listProduct->fetch_assoc()) {
        if (strpos($row["proname"], $_POST['search-item']) !== false) {
            array_push($GLOBALS['itemID'], $row['proid']);
        }
    }
    header("Location: ../../index.php?act=product&feature=searching");
    $conn->close();
}
