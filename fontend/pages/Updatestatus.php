<?php
require('../../db/connect.php');
if (isset($_GET['orderid']) && isset($_POST['status'])) {
    $status = $_POST['status'];
    $getOD = $_GET['orderid'];

    echo "Status: " . htmlspecialchars($status) . "<br>";
    echo "Order ID: " . htmlspecialchars($getOD) . "<br>";

    $sql = "UPDATE orders SET status = ? WHERE orderid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $getOD);
    if ($stmt->execute()) {
        header("Location: ../../adminpanel/pages/index.php?act=DonHang");
    } else {
        echo "Cập nhật thất bại" . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Không nhận được ID hoặc status";
}
?>