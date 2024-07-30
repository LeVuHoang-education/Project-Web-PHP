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

?>