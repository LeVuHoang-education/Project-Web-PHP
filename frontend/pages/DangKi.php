<?php
session_start();

require('../../db/connect.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Sử dụng câu lệnh chuẩn bị để bảo vệ chống SQL Injection
    $stmt = $conn->prepare("INSERT INTO account (username, email, phonenumber, password, gender) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $phonenumber, $password, $gender);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        echo json_encode(['success' => true, 'message' => 'Đăng ký thành công']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Đăng ký thất bại.']);
    }
    exit();
    $stmt->close();
}
$conn->close();
