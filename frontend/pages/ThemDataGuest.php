<?php
session_start();
require __DIR__ . '../../../db/connect.php';
// echo '<pre>';
// print_r($_POST);
// print_r($_SESSION);
// echo '</pre>';
if (!isset($_SESSION['guest_id'])) {
    $name = $_POST['guestname'];
    $phone = $_POST['guestphone'];
    $address = $_POST['guestaddress'];
    $mail = $_POST['guestmail'];
    if (empty($name) || empty($phone) || empty($address) || empty($mail)) {
        echo "<script> 
        alert 'Vui lòng điền đầy đủ thông tin'
        </script> ";
        exit();
    }

    $sql = "INSERT INTO guest (guestname, guestphone, guestaddress, guestmail) VALUES (? , ? , ? , ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        exit();
    }
    $stmt->bind_param("ssss", $name, $phone, $address, $mail);
    if ($stmt->execute()) {
        $guest_id = $conn->insert_id;
        echo "Dữ liệu đã được lưu thành công.";
        $_SESSION['guest_id'] = $guest_id;
    } else {
        echo "Lỗi lưu dữ liệu: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
