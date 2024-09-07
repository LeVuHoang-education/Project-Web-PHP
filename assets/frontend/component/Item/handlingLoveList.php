<?php

function saveLoveProduct($proid, $userid)
{
    global $conn;
    $sql = "INSERT INTO `love-list` (userid, proid) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $proid, $userid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])  && $_SESSION["user_id"] != null) {
    $userid = $_SESSION['user_id'];
    include_once __DIR__ . "../../../../../frontend/pages/Function.php";

    // Nhận dữ liệu từ yêu cầu POST
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['prodID'];

    // Lưu dữ liệu vào session (ví dụ: thêm vào giỏ hàng)
    if (!isset($_SESSION['lovelist'])) {
        $_SESSION['lovelist'] = [];
        array_push($_SESSION['lovelist'], $productId);

        if (saveLoveProduct($productId, $userid)) {
            // Prepare response as JSON
            $response = [
                'message' => 'success', // Adjust message as needed
            ];
        } else {
            // Prepare response as JSON
            $response = [
                'message' => 'error', // Adjust message as needed
            ];
        }
    } else  if (!in_array($productId, $_SESSION['lovelist'])) {
        array_push($_SESSION['lovelist'], $productId);
        // Prepare response as JSON
        $response = [
            'message' => 'success', // Adjust message as needed
        ];
    } else {
        foreach ($_SESSION['lovelist'] as $key => $value) {
            if ($value == $productId) {
                unset($_SESSION['lovelist'][$key]);
                break;
            }
        }
        // Prepare response as JSON
        $response = [
            'message' => 'delete', // Adjust message as needed
        ];
    }
    // Set content type header (optional, but recommended for JSON responses)
    header('Content-Type: application/json');

    echo json_encode($response);
} else {
    // Prepare response as JSON
    $response = [
        'message' => 'notallow.',
    ]; // Adjust message as needed
    header('Content-Type: application/json');

    echo json_encode($response);
}
