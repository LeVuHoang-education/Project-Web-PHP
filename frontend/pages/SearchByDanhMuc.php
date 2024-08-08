<?php
require("../../db/connect.php");
function searchByDanhMuc($catid)
{   
    global $conn;
    $sql = "SELECT * FROM product WHERE catid = $catid";
    $result = mysqli_query($conn, $sql);
}
function getProduct(){
    global $conn;
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
}
?>