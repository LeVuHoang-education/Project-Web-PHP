<?php
session_start();
require_once "../../db/connect.php";
include __DIR__ .  "/Function.php";
if (isset($_POST['ThemDC'])) {
    $city = htmlspecialchars($_POST['city-name']);
    $district = $_POST['district-name'];
    $ward = $_POST['ward-name'];
    $number_house = htmlspecialchars($_POST['number-house']);
    $id = $_SESSION['user_id'];

    echo $id, ' ', $city,' ', $district,' ', $ward,' ', $number_house;
    $sql = "INSERT INTO dckh (userid,city, district	,ward,number_house) VALUES (? , ? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $id, $city, $district, $ward, $number_house);


    if ($stmt->execute()) {
        header("Location: ../../index.php?act=account&feature=brief");
        echo "<script>alert('Thêm địa chỉ thành công')</script>";
        exit();
    } else {
        header("Location:../../index.php?act=account&feature=brief");
        echo "<script>alert('Add failed')</script>";
        exit();
    }
    $stmt->close();
    $conn->close();
} else echo "<script>alert('get ThemDC faild')</script>";
