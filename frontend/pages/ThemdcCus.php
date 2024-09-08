<?php
session_start();
require_once "../../db/connect.php";
include __DIR__ .  "/Function.php";
if (isset($_POST['city-name'])) {
    $city = htmlspecialchars($_POST['city-name']);
    $district = $_POST['district-name'];
    $ward = $_POST['ward-name'];
    $number_house = htmlspecialchars($_POST['number-house']);
    $id = $_SESSION['user_id'];

    $sql = "INSERT INTO dckh (userid,city, district	,ward,number_house) VALUES (? , ? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $id, $city, $district, $ward, $number_house);


    if ($stmt->execute()) {
        $lastId = $conn->insert_id;
        $updateSql = "UPDATE dckh SET defaultDC = 1 WHERE userid = ? AND idDC = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $id, $lastId);
        $updateStmt->execute();
        $updateStmt->close();
        echo "OK";
    } else {
        echo "Lỗi: Không thể thêm địa chỉ.";
    }
    $stmt->close();
    $conn->close();
} else echo "<script>alert('get ThemDC faild')</script>";
