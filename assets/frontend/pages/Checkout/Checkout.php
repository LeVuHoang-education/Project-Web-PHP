<?php 
session_start();
require_once __DIR__ . "../../../../../frontend/pages/Function.php";
require_once __DIR__ . "../../../../../db/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $itemTotal = $_POST['total'];


    
}