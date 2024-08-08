<?php
session_start();
require('../../db/connect.php');

// Kiểm tra xem các biến POST có tồn tại hay không
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sử dụng prepared statements để ngăn chặn SQL injection
    $stmt = $conn->prepare("SELECT * FROM account WHERE email = ? AND password = ?");

    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);

    // Kiểm tra xem câu truy vấn có thành công hay không
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row != null) {
            // Đăng nhập thành công
            echo "Login successful";
            $_SESSION['user_id'] = $row['userid']; //Luu thong tin vao session de su dung
            header("Location: ../../index.php");
        } else {
            echo "Login failed";
        }
    } else {
        // Hiển thị lỗi nếu câu truy vấn thất bại
        echo "Error executing query: " . $stmt->error;
    }

    // Đóng prepared statement và kết nối
    $stmt->close();
    $conn->close();
} else {
    echo "Email and password are required";
}
?>