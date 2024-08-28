<?php
session_start();
require('../../db/connect.php');

if (isset($_POST['oldpassword'])) {
    $oldPassword = $_POST['oldpassword'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT password FROM account WHERE userid = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Kiểm tra mật khẩu cũ
    if (password_verify($oldPassword, $hashedPassword)) {
        echo json_encode(['valid' => true]);
    } else {
        echo json_encode(['valid' => false]);
    }
}

$conn->close();