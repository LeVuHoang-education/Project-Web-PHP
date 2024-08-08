<?php
session_start();
require_once "../../db/connect.php";
include "Function.php";
if(isset($_POST['doimk']) && $_POST['password'] == getPasswordbyID($_SESSION['user_id'])) {
    $Password = htmlspecialchars($_POST['new_password']);
    $id = $_SESSION['userid'];

    $sql = "UPDATE account SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $Password, $id);

    if($stmt->execute()) {
        echo "<script>alert('Đổi mật khẩu thành công!');</script>";
        header("Location:../../index.php?act=Doimk");
        exit();
    } else {
        echo "<script>alert('Đổi mật khẩu thất bại!');</script>";
    }
    $stmt->close();
    $conn->close();
}
else {
    echo "<script>alert('Mật khẩu không đúng!');</script>";
}

?>