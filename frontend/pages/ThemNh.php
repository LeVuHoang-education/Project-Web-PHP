<?php
session_start();
require __DIR__ . '../../../db/connect.php';
if (isset($_POST['ThemNH'])) {
    $id = $_SESSION['user_id'];
    $account_number = $_POST['account_number'];
    $bank_name = $_POST['bank_name'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];
    $account_name = $_POST['account_name'];

    $encrypt_account_number = encryptData($account_number);
    $encrypt_cvv = encryptData($cvv);

    $sql = "INSERT INTO tknh (userid, account_number, bank_name , expiration_date, cvv, account_name) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $id, $encrypt_account_number, $bank_name, $expiration_date, $encrypt_cvv, $account_name);
    if ($stmt->execute()) {
        echo "<script>alert('Thêm thẻ ngân hàng thành công!');</script>";
        header("Location:../../index.php?act=LKNH");
        exit();
    } else {
        echo "<script>alert('Thêm thẻ ngân hàng thất bại!');</script>";
        header("Location:../../index.php?act=LKNH");
    }
}
