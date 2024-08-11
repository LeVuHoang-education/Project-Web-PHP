<?php
session_start();
require __DIR__ . '/Function.php';
require __DIR__ . '../../../db/connect.php';
$UserCart = getUserbyID($_SESSION['userid'])->fetch_assoc()['order_status'];
if (isset($_GET['muangay'])) {
    $userid = $_SESSION['userid'];
    $proid  = $_GET['proid'];

    //Lay so luong va gia cua item duoc chon
    $Itemprice = getProductbyID($proid)->fetch_assoc()['proprice'];
    $ItemQuantity = getItembyID($proid)->fetch_assoc()['quantity'];
    if ($UserCart == 0) { //Neu nhu chua co don hang nao thi tao don va add item nay vao

        $orderdate = date('Y-m-d H:i:s');
        //tong tien
        $totalmount = $Itemprice * $ItemQuantity;

        //them order
        $AddOrderSql = "INSERT INTO orders (userid, orderdate, totalmount) VALUES (? , ? , ?)";
        $stmt = $conn->prepare($AddOrderSql);
        $stmt->bind_param("isd", $userid, $orderdate, $totalmount);
        if ($stmt->execute()) {
            $orderid = $conn->insert_id;

            $AddItemSql = "INSERT INTO order_detail (orderid, proid, quantity, itemprice) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($AddItemSql);
            $stmt->bind_param("iiid", $orderid, $proid, $ItemQuantity, $Itemprice);
            if ($stmt->execute()) {
                header('Location: ../../index.php?act=cart');
                echo "<script>alert('Đã tạo đơn hàng và thêm chi tiết thành công')</script>";
                exit();
            } else {
                header('Location: ../../index.php?act=cart');
                echo "<script>alert('Thêm chi tiết đơn hàng thất bại')</script>";
                exit();
            }
        } else {
            header('Location: ../../index.php');
            echo "<script>alert('Tạo đơn hàng thất bại')</script>";
            exit();
        }
        $stmt->close();
    } else { //Neu nhu da co don hang thi add item nay vao don hang do
        $orderid = getCartbyID($userid)->fetch_assoc()['orderid']; //lay id don hang dang cho xu li 
        $TongTien = getOrderbyID($orderid)->fetch_assoc()['totalmount'];
        $totalmount =  $TongTien + ($Itemprice * $ItemQuantity);

        //Them item vao don hang
        $UpdateOrderSql = "UPDATE orders SET totalmount = ? WHERE orderid = ?";
        $stmt = $conn->prepare($UpdateOrderSql);
        $stmt->bind_param("di", $totalmount, $orderid);
        if ($stmt->execute()) {

            $AddItemSql = "INSERT INTO order_detail (orderid, proid, quantity, itemprice) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($AddItemSql);
            $stmt->bind_param("iiid", $orderid, $proid, $ItemQuantity, $Itemprice);
            if ($stmt->execute()) {
                header('Location: ../../index.php?act=cart');
                echo "<script>alert('Đã thêm sản phẩm vào giỏ hàng')</script>";
                exit();
            } else {
                header('Location: ../../index.php?act=cart');
                echo "<script>alert('Thêm sản phẩm thất bại')</script>";
                exit();
            }
        } else {
            header('Location: ../../index.php');
            echo "<script>alert('Cập nhật đơn hàng thất bại')</script>";
            exit();
        }
    }
    $stmt->close();
    $conn->close();
}
