<?php
require_once __DIR__ . '/../../../../db/connect.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function generateRandomPassword($length = 8)
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';

    $password = '';
    $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];

    $allCharacters = $uppercase . $lowercase . $numbers;
    for ($i = 3; $i < $length; $i++) {
        $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
    }

    return str_shuffle($password);
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT userid FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $newPassword = generateRandomPassword();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt->bind_result($user_id);
        $stmt->fetch();
        $updateStmt = $conn->prepare("UPDATE account SET password = ? WHERE email = ?");
        $updateStmt->bind_param("ss", $hashedPassword, $email);
        $updateStmt->execute();

        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bx1536hoang@gmail.com';
            $mail->Password   = 'bjyy swhc vvzl zdth';
            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_SMTPS;
            //PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 465;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = PHPMailer::ENCODING_BASE64;
            $mail->setFrom('bx1536hoang@gmail.com', 'NhatHoang furniture');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Đặt lại mật khẩu';
            $mail->Body    = 'Mật khẩu mới của bạn là: ' . $newPassword;

            $mail->send();
            echo 'Email đã được gửi. Kiểm tra email của bạn để đặt lại mật khẩu.';
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }

        $updateStmt->close();
    } else {
        echo "Email không tồn tại trong hệ thống.";
    }

    $stmt->close();
    $conn->close();
}
?>
<style>
    .DLMK_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        width: 100%;
        ;
    }

    .DLMK-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 30%;
        height: 30vh;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .DLMK-form h2 {
        margin-bottom: 20px;
    }

    .DLMK-form input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .DLMK-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        cursor: pointer;
        background-color: orange;
        color: white;
    }

    .DLMK-form input[type="submit"]:hover {
        background-color: #f1f1f1;
        color: black;
    }
</style>

<div class="DLMK_container">
    <div class="DLMK-form">
        <h2>Đặt lại mật khẩu</h2>
        <form id="forgotPasswordForm" method="post">
            <label for="email">Nhập email</label><br>
            <input type="email" id="email" name="email" required placeholder="Email">
            <input type="submit" value="Gửi yêu cầu">
        </form>
    </div>
</div>