<?php
require('../../db/connect.php');

// Kiểm tra và lấy các giá trị từ GET và POST
if (isset($_POST['userid']) && isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['gender']) && isset($_POST['birthday'])) {
    $userid = $_GET['userid'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    // Câu lệnh chuẩn bị
    $UpdateUser_sql = "UPDATE account SET username = ?, email = ?, phonenumber = ?, gender = ? WHERE userid = ?";
    $stmt = $conn->prepare($UpdateUser_sql);

    if ($stmt) {
        // Liên kết các tham số
        $stmt->bind_param("ssssi", $username, $email, $phonenumber, $gender, $userid);
        $stmt->execute();

        $UpdateUser_sql = "UPDATE `ttkh` SET birthday = ? WHERE userid = ?";
        $stmt = $conn->prepare($UpdateUser_sql);
        // Giả sử $birthday là một đối tượng DateTime
        $birthdayString = $birthday->format('Y-m-d');

        $stmt->bind_param("si", $birthdayString, $userid);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            // Chuyển hướng sau khi cập nhật thành công
            header("Location:../../adminpanel/pages/index.php?act=TaiKhoan");
            exit();
        } else {
            echo "Cập nhật không thành công hoặc không có thay đổi.";
        }

        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh.";
    }

    $conn->close();
} else {
    echo "Dữ liệu không đầy đủ.";
}
