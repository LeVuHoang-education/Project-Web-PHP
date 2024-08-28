<?php
session_start();
require('../../db/connect.php');

if (isset($_POST['oldpassword']) && isset($_POST['newpassword'])) {
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $userId = $_SESSION['user_id'];

    // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT password FROM account WHERE userid = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Kiểm tra mật khẩu cũ
    if (password_verify($oldPassword, $hashedPassword)) {
        // Mã hóa mật khẩu mới
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $stmt = $conn->prepare("UPDATE account SET password = ? WHERE userid = ?");
        $stmt->bind_param("si", $newHashedPassword, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Mật khẩu đã được cập nhật thành công.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cập nhật mật khẩu không thành công.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không chính xác.']);
    }
}

$conn->close();