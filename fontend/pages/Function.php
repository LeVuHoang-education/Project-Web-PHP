<?php
    require('../../db/connect.php');
    function getOrder() {
        global $conn;
        $getOD_sql = "SELECT * FROM orders order by orderid";
        $result = $conn->query($getOD_sql);
        return $result;
    }
    function getOrderbyID($id) {
        global $conn;
        $getOD_sql = "SELECT * FROM orders where orderid = $id";
        $result = $conn->query($getOD_sql);
        return $result;
    }
    function getItembyID($id) {
        global $conn;
        $getItem_sql  = "SELECT * FROM orders_item where orderid = $id";
        $result = $conn->query($getItem_sql);
        return $result;
    }
    function getProductbyID($id) {
        global $conn;
        $getProduct_sql = "SELECT * FROM product where proid = $id";
        $result = $conn->query($getProduct_sql);
        return $result;
    }
?>