<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['product_list'])) {
    header('Location: ../../../../../index.php?act=GioHang');
    exit();
}
