<?php
require('../../db/connect.php');
require_once __DIR__ . '../../../frontend/pages/Function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

require_once '../../vendor/autoload.php';
if (isset($_GET['orderid']) && isset($_POST['status'])) {
    $status = $_POST['status'];
    $getOD = $_GET['orderid'];

    echo "Status: " . htmlspecialchars($status) . "<br>";
    echo "Order ID: " . htmlspecialchars($getOD) . "<br>";

    $sql = "UPDATE orders SET status = ? WHERE orderid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $getOD);
    if ($stmt->execute()) {

        $sql = "SELECT * FROM orders WHERE orderid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $getOD);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['userid'] != null) {
            $data = getUserbyID($row['userid']);
            $email = $data->fetch_assoc()['email'];
        } else {
            $data = getGuestbyID($row['guestid']);
            $email = $data->fetch_assoc()['guestmail'];
        }
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username   = 'bx1536hoang@gmail.com';
            $mail->Password   = 'bjyy swhc vvzl zdth';
            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom('bx1536hoang@gmail.com', 'NhatHoang furniture');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your Orders';
            $mail->Body    = '
            Đơn hàng: <b>' . $getOD . '</b>' . '<br>' . '
            Trạng thái đơn hàng của bạn:  <b>' . $status . '</b>';

            $mail->send();
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }

        header("Location: ../../adminpanel/pages/index.php?act=DonHang");
    } else {
        echo "Cập nhật thất bại" . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Không nhận được ID hoặc status";
}
