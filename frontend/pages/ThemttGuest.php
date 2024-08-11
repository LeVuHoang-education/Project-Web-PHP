<?php
require __DIR__ . '../../../db/connect.php';
include __DIR__ . '../../../frontend/pages/Function.php';
if (isset($_GET['ThemTTGuest'])) {

    $guestname = $_POST['guestname'];
    $guestphone = $_POST['guestphone'];
    $guestaddress = $_POST['guestaddress'];


    $sql = "INSERT INTO guest (guestname, guestphone, guestaddress) VALUES (? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $guestname, $guestphone, $guestaddress);
    if ($stmt->execute()) {
        header('location: ../../../index.php');
        echo "<script>alert('Thêm thông tin thành công!')</script>";
        exit();
    } else {
        header('location: ../../../index.php');
        echo "<script>alert('Thêm thông tin thất bại!')</script>";
        exit();
    }
}
