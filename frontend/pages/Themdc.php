<?php
session_start();
require_once "../../db/connect.php";
if (isset($_POST['ThemDC'])) {
    $tinh = htmlspecialchars($_POST['tinh']);
    $diachi = htmlspecialchars($_POST['diachi']);
    $id = $_SESSION['user_id'];

    $sql = "INSERT INTO dckh (userid,city, address) VALUES (? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id, $tinh, $diachi);

    if ($stmt->execute()) {
        header("Location: ../../index.php?act=DiaChi");
    } else {
        echo "Add failed";
    }
    $stmt->close();
    $conn->close();
}
