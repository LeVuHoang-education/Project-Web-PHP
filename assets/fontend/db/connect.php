<?php
$servername = "localhost";
$username = "user2";
$password = "";
$dbname = "quanlibanhangnoithat";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>