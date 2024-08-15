<?php
session_start();
require_once "../../db/connect.php";
include __DIR__ .  "/Function.php";
if (isset($_POST['ThemDC'])) {
    $apiUrl = 'https://esgoo.net/api-tinhthanh/1/0.htm';
    $dataFetch = fetchDataFromAPi($apiUrl);
    foreach ($dataFetch['data'] as $TP){
        if($TP['name'] == $_POST['city-name']) {
            $city = $TP['name'];
            break;
        }
    }

    $apiUrl='https://esgoo.net/api-tinhthanh/2/'.$city.'/htm';
    $dataFetch = fetchDataFromAPi($apiUrl);
    foreach ($dataFetch['data'] as $Q){
        if($Q['name'] == $_POST['district-name']) {
            $district = $Q['name'];
            break;
        }
    }

    $apiUrl='https://esgoo.net/api-tinhthanh/3/'.$district.'/htm';
    $dataFetch = fetchDataFromAPi($apiUrl);
    foreach ($dataFetch['data'] as $Q){
        if($Q['name'] == $_POST['ward-name']) {
            $ward = $Q['name'];
            break;
        }
    }
    
    $number_house = htmlspecialchars($_POST['number-house']);
    $id = $_SESSION['user_id'];

    echo $id, $city, $district, $ward, $number_house;
    $sql = "INSERT INTO dckh (userid,city, district	,ward,number_house) VALUES (? , ? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $id, $city, $district, $ward, $number_house);


    if ($stmt->execute()) {
        header("Location: ../../index.php?act=account");
        echo "<script>alert('Thêm địa chỉ thành công')</script>";
        exit();
    } else {
        header("Location:../../index.php?act=account");
        echo "<script>alert('Add failed')</script>";
        exit();
    }
    $stmt->close();
    $conn->close();
} else echo "<script>alert('get ThemDC faild')</script>";
