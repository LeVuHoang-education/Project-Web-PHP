<?php
session_start();
require('../../db/connect.php');
header('Content-Type: application/json');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sử dụng prepared statements để ngăn chặn SQL injection
    $stmt = $conn->prepare("SELECT * FROM account WHERE email = ?");

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => "Error preparing the SQL statement: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $email);

    // Kiểm tra xem câu truy vấn có thành công hay không
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row != null) {
            // Kiểm tra mật khẩu
            if ($password == $row['password']) {
                // Đăng nhập thành công
                if ($row['userrole'] == 'admin') {
                    $_SESSION['admin_id'] = $row['userid'];
                    echo json_encode(['success' => true, 'redirect' => 'adminpanel/pages/index.php']);
                } else {
                    $_SESSION['user_id'] = $row['userid'];
                    echo json_encode(['success' => true, 'message' => 'Login successful']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Error executing query: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
}
