<?php
session_start();
require('../../db/connect.php');
header('Content-Type: application/json');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tìm người dùng với email đã cung cấp
    $stmt = $conn->prepare("SELECT userrole, userid, password FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userrole, $userid, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Kiểm tra mật khẩu đã nhập với mật khẩu đã băm trong cơ sở dữ liệu
        if (password_verify($password, $hashed_password)) {
            // Mật khẩu đúng, đăng nhập thành công
            if ($userrole == 'admin') {
                $_SESSION['admin_id'] = $userid;
                echo json_encode(['success' => true, 'redirect' => 'adminpanel/pages/index.php']);
            } else {
                $_SESSION['user_id'] = $userid;
                echo json_encode(['success' => true, 'message' => 'Đăng nhập thành công']);
                if (!isset($_SESSION['lovelist'])) {
                    $_SESSION['lovelist'] = [];
                    $sql = "SELECT proid FROM `love-list` WHERE userid=$userid";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        array_push($_SESSION['lovelist'], $row['proid']);
                    }
                }
            }
        } else {
            // Mật khẩu sai
            echo json_encode(['success' => false, 'message' => 'Mật khẩu không đúng']);
        }
    } else {
        // Email không tồn tại
        echo json_encode(['success' => false, 'message' => 'Email không tồn tại']);
    }

    $stmt->close();
    $conn->close();
    exit();
}
