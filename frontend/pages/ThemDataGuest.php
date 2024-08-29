<?php
session_start();
require __DIR__ . '../../../db/connect.php';

if (!isset($_SESSION['guest_id'])) {
    $name = $_POST['guestname'];
    $phone = $_POST['guestphone'];
    $address = $_POST['guestaddress'];
    $mail = $_POST['guestmail'];

    if (empty($name) || empty($phone) || empty($address) || empty($mail)) {
        echo "Lỗi: Vui lòng điền đầy đủ thông tin";
        exit();
    }

    $sql = "INSERT INTO guest (guestname, guestphone, guestaddress, guestmail) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ssss", $name, $phone, $address, $mail);

    if (!$stmt->execute()) {
        echo "Lỗi lưu dữ liệu: " . $stmt->error;
    } else {
        $guest_id = $conn->insert_id;
        $_SESSION['guest_id'] = $guest_id;
        echo "Thành công";
    }

    $stmt->close();
    $conn->close();
}
?>
