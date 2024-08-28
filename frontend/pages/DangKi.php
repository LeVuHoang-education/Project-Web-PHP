<?php
session_start();
require('../../db/connect.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Kiểm tra xem email đã được đăng ký chưa
    $stmt = $conn->prepare("SELECT * FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email đã được đăng ký.']);
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO account (username, email, phonenumber, password, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $phonenumber, $hashed_password, $gender);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            echo json_encode(['success' => true, 'message' => 'Đăng ký thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Đăng ký thất bại.']);
        }
    }

    $stmt->close();
    $conn->close();
    exit();
}
