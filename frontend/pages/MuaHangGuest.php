<?php
session_start();
require __DIR__ . '../../../db/connect.php';
// echo '<pre>';
// print_r($_POST);
// print_r($_SESSION);
// echo '</pre>';
if (isset($_POST['cartid'])) {
    $pttt = $_POST['pttt'];
    $dsitem = explode(',', $_POST['cartid']);

    $now = date('Y-m-d H:i:s');

    $total = 0;

    // Tính tổng tiền
    foreach ($dsitem as $item) {
        foreach ($_SESSION['cart'] as $sessionItem) {
            if ($sessionItem[0] == $item) {
                $total += (floatval($sessionItem[2]) * floatval($sessionItem[3]));
            }
        }
    }

    // Chuẩn bị truy vấn để thêm vào bảng orders
    $sql = "INSERT INTO orders (guestid, orderdate, totalmount, payment_status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt == false) {
        die("Lỗi khi chuẩn bị truy vấn SQL: " . $conn->error);
    }

    // Kiểm tra giá trị truyền vào
    if (!isset($_SESSION['guest_id'])) {
        die("Lỗi: guest_id không tồn tại trong session.");
    }
    if (!$stmt->bind_param("isds", $_SESSION['guest_id'], $now, $total, $pttt)) {
        die("Lỗi khi gán tham số: " . $stmt->error);
    }

    // Thực thi truy vấn orders
    if ($stmt->execute()) {
        $orderID = $stmt->insert_id;

        // Chuẩn bị truy vấn để thêm vào bảng order-detail
        $itemStmt = $conn->prepare("INSERT INTO `order-detail` (orderid, proid, quanitity, price) VALUES (?, ?, ?, ?)");
        if ($itemStmt == false) {
            die("Lỗi khi chuẩn bị truy vấn SQL: " . $conn->error);
        }

        // Thêm chi tiết đơn hàng
        foreach ($dsitem as $item) {
            foreach ($_SESSION['cart'] as $sessionItem) {
                if ($sessionItem[0] == $item) {
                    if (!$itemStmt->bind_param("iiid", $orderID, $sessionItem[0], $sessionItem[2], $sessionItem[3])) {
                        die("Lỗi khi gán tham số vào order-detail: " . $itemStmt->error);
                    }
                    if (!$itemStmt->execute()) {
                        die("Lỗi khi thêm dữ liệu vào bảng order-detail: " . $itemStmt->error);
                    } else {
                        // Xóa sản phẩm khỏi session sau khi thêm vào order-detail thành công
                        foreach ($_SESSION['cart'] as $key => $cartItem) {
                            if ($cartItem[0] == $sessionItem[0]) {

                                $Updatequantity = $conn->prepare("UPDATE product SET prostock = prostock - ? WHERE proid = ?");
                                $Updatequantity->bind_param("ii", $sessionItem[2], $sessionItem[0]);
                                $Updatequantity->execute();
                                $Updatequantity->close();

                                $checkStock = $conn->prepare("SELECT prostock FROM product WHERE proid = ?");
                                $checkStock->bind_param("i", $sessionItem[0]);
                                $checkStock->execute();
                                $checkStock->bind_result($currentStock);
                                $checkStock->fetch();
                                $checkStock->close();

                                if ($currentStock == 0) {
                                    $disableProduct = $conn->prepare("UPDATE product SET is_active = '0' WHERE proid = ?");
                                    if ($disableProduct === false) {
                                        die("Lỗi khi chuẩn bị truy vấn SQL: " . $conn->error);
                                    }
                                    $disableProduct->bind_param("i", $sessionItem[0]);
                                    $disableProduct->execute();
                                    $disableProduct->close();
                                }
                                $checkStock->close();

                                unset($_SESSION['cart'][$key]);
                                break;
                            }
                        }
                    }
                }
            }
        }
        // Đóng kết nối
        $itemStmt->close();
        $stmt->close();
        $conn->close();
        echo '<script>alert("Đặt hàng thành công");</script>';
        header('Location: ../../index.php?act=GioHang');
        exit();
    } else {
        echo '<script>alert("Đặt hàng thất bại");</script>';
        error_log("Lỗi khi thêm đơn hàng vào bảng orders: " . $stmt->error);
        header('Location: ../../index.php');
        exit();
    }
}
