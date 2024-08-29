<?php
    require('../../db/connect.php');

    // Kiểm tra và lấy các giá trị từ GET và POST
    if (isset($_GET['userid']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['gender'])) {
        $userid = $_GET['userid'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $gender = $_POST['gender'];
        $userrole = $_POST['userrole'];

        // Câu lệnh chuẩn bị
        $UpdateUser_sql = "UPDATE account SET username = ?, email = ?, phonenumber = ?, gender = ?, userrole = ? WHERE userid = ?";
        $stmt = $conn->prepare($UpdateUser_sql);

        if ($stmt) {
            // Liên kết các tham số
            $stmt->bind_param("ssssssi", $username, $email, $phonenumber, $gender,$userrole, $userid);
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
?>