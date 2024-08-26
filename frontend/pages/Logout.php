<?php
session_start(); // Bắt đầu hoặc tiếp tục session hiện tại

// Kiểm tra nếu yêu cầu đến từ `beforeunload`
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    // Xóa tất cả các biến trong session
    session_unset();

    // Hủy session hiện tại
    session_destroy();

    // Xóa cookie session (nếu có)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
}
