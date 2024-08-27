<?php
require_once "../../db/connect.php";
if (isset($_POST["default"])) {
    if (isset($_POST["currentDefault"])) {
        $default = $_POST["currentDefault"];
        $query = "UPDATE `dckh` SET defaultDC = 0 WHERE idDC = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $default);
        $stmt->execute();
    }
    $default = $_POST["default"];
    $query = "UPDATE `dckh` SET defaultDC = 1 WHERE idDC = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $default);

    if (!$stmt->execute()) {
        echo "<script>alert('Đổi địa chỉ mặc định thất bại!');</script>";
        exit();
    } else {
        echo "<script>alert('Đổi địa chỉ mặc định thất bại!');</script>";
    }
    $stmt->close();
    $conn->close();
    header("Location: ../../index.php?act=account&feature=address");
}
