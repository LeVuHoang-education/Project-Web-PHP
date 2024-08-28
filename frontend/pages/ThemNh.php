<?php
session_start();
require __DIR__ . '../../../db/connect.php';
if (isset($_POST['add-account-bank'])) {
    $bank_name = $_POST['bank-name'];
    $account_number = $_POST['account-number'];
    $account_name = $_POST['account-name'];
    $exp_date = $_POST['exp-date'];
    $cvv_number = $_POST['cvv-number'];

    $sql = "INSERT INTO tknh (userid,account_number,bank_name,expiration_date,cvv,account_name) VALUES (? , ? , ? , ? , ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $_SESSION['user_id'], $account_number, $bank_name, $exp_date, $cvv_number, $account_name);

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
}
