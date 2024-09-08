<?php
require __DIR__ . '../../../db/connect.php';
function getOrder()
{
    global $conn;
    $getOD_sql = "SELECT * FROM orders order by orderid";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getOrderbyID($id)
{
    global $conn;
    $getOD_sql = "SELECT * FROM orders where orderid = $id";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getCartbyID($id)
{
    global $conn;
    $getOD_sql = "SELECT * FROM `orders` WHERE userid = $id and status = 'Đang chờ xử lí'";
    $result = $conn->query($getOD_sql);
    return $result;
}
function getItembyID($id)
{
    global $conn;
    $getItem_sql  = "SELECT * FROM `order-detail` where orderid = $id";
    $result = $conn->query($getItem_sql);
    return $result;
}
function getProductbyID($id)
{
    global $conn;
    $getProduct_sql = "SELECT * FROM product where proid = ?";
    $stmt = $conn->prepare($getProduct_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
define('ENCRYPTION_KEY', 'your-secret-key-here');
//ma hoa du lieu (tk ngan hang)
function encryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}
//giai ma du lieu (tk ngan hang)
function decryptData($data)
{
    $key = hash('sha256', ENCRYPTION_KEY);
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}
//lay stk nh
function getNhbyID($id)
{
    global $conn;
    $getAccountBank_sql = "SELECT * FROM `tknh` where userid = $id";
    $result = $conn->query($getAccountBank_sql);
    return  $result;
}
//lay address cua khach hang
function getAddressbyID($id)
{
    global $conn;
    $getAddress_sql = "SELECT * FROM address where id = $id";
    $result = $conn->query($getAddress_sql);
    return $result;
}
function getUserbyID($id)
{
    global $conn;
    $getPassword_sql = "SELECT * FROM account where userid = ?";
    $stmt = $conn->prepare($getPassword_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function getGuestbyID($id)
{
    global $conn;
    $getGuest_sql = "SELECT * FROM guest where guestid = ?";
    $stmt = $conn->prepare($getGuest_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}



function fetchDataFromAPi($url)
{
    $curl = curl_init();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $data = json_decode($result, true);
    } else {
        echo "API không còn hoạt động hoặc không truy cập được. Mã HTTP: $httpCode";
    }
    return $data;
}

function themItemCart($userID, $proID, $quantity, $price)
{
    global $conn;
    $sql = "INSERT INTO `cart-item` (userID, proID, quantity, itemprice) VALUES ( ? , ? , ? , ? )";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SQL: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("iiii", $userID, $proID, $quantity, $price);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
}
function updateQuantityItemCart($userID, $proID, $quantity)
{
    global $conn;
    $sql = "UPDATE `cart-item` SET quantity = ? WHERE userID = ? and proID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $userID, $proID);
    $stmt->execute();
    $stmt->close();
}
function delItemCart($userID, $proID)
{
    global $conn;
    $sql = "DELETE FROM `cart-item` WHERE userID = ? and proID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userID, $proID);
    $stmt->execute();
    $stmt->close();
}
function delAllItemCart($userID)
{
    global $conn;
    $sql = "DELETE FROM `cart-item` WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->close();
}
function getAllItemCart($userID)
{
    global $conn;
    $sql = "SELECT `cart-item`.*, product.image_path, product.proname,product.sales FROM `cart-item` INNER JOIN product ON `cart-item`.proID = product.proid WHERE `cart-item`.userID = ? ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SQL: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $userID);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }

    return $result;
}


//lay tt thanh toan
function getTTKH($id)
{
    global $conn;
    $getTTKH = "SELECT * FROM ttkh WHERE userid = ?";
    $stmt = $conn->prepare($getTTKH);
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }
    return $result;
}

function getDC($id)
{
    global $conn;
    $getDC = "SELECT * FROM dckh WHERE userid = ?";
    $stmt = $conn->prepare($getDC);
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }
    return $result;
}

function getItemCartbyID($id, $proID)
{
    global $conn;
    $getsql = "SELECT * FROM `cart-item` WHERE userID = ? AND proID = ?";
    $stmt = $conn->prepare($getsql);
    $stmt->bind_param("ii", $id, $proID);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }
    return $result;
}

function getItembyCartID($cartid)
{
    global $conn;
    $sql = "SELECT `cart-item`.*, product.image_path, product.proname FROM `cart-item` INNER JOIN product ON `cart-item`.proID = product.proid WHERE `cart-item`.cartid = ? ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SQL: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $cartid);
    if (!$stmt->execute()) {
        die("Lỗi execute SQL: (" . $stmt->errno . ") " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result === false) {
        die("Lỗi get_result: (" . $stmt->errno . ") " . $stmt->error);
    }

    return $result;
}

function getProductBySugestion($catid)
{
    global $conn;
    $type = [];
    $sql = "SELECT * FROM `product` WHERE catid = $catid AND prostock>'0' AND is_outstanding='1'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $type[] = $row['proid'];
    }
    $GLOBALS['itemID'] = $type;

    include "./assets/frontend/component/suggestion/suggestion.php";
}

//ham tao link phan trang va cac ham lien quan
function createPagination($base_url, $total_rows, $serial_page, $page_size = 10, $offset = 1)
{
    if ($serial_page <= 0) {
        return "";
    };

    $total_pages = ceil($total_rows / $page_size);
    if ($total_pages <= 1) {
        return "";
    }

    $links = "<ul class='pagination'>";

    //hien 2 link dan den trang dau va cuoi
    if ($serial_page > 1) {
        $page_prev = $serial_page - 1;
        $first = "<li><a href='{$base_url}&serial_page=1'> << </a></li>";
        $prev = "<li><a href='{$base_url}&serial_page={$page_prev}'> < </a></li>";
        $links .= $first . $prev;
    };

    //hien so trang o giua
    if ($serial_page + $offset - 1 <= $total_pages) {
        for ($i = $serial_page; $i <= $serial_page + $offset - 1; $i++) {
            if ($i == $serial_page)
                $page = "<li style='background-color: var(--icon-bg);'><a href='{$base_url}&serial_page={$i}'> {$i}</a></li>";
            else
                $page = "<li><a href='{$base_url}&serial_page={$i}'> {$i}</a></li>";
            $links .= $page;
        }
    } else {
        if ($total_pages - $offset + 1 <= 0) {
            $start = 1;
        } else $start = $total_pages - $offset + 1;
        
        for ($i = $start; $i <= $total_pages; $i++) {
            if ($i == $serial_page)
                $page = "<li style='background-color: var(--icon-bg);'><a href='{$base_url}&serial_page={$i}'> {$i}</a></li>";
            else
                $page = "<li><a href='{$base_url}&serial_page={$i}'> {$i}</a></li>";
            $links .= $page;
        }
    }

    //hien 2 link dan den trang cuoi va ke cuoi
    if ($serial_page < $total_pages) {
        $page_next = $serial_page + 1;
        $next = "<li><a href='{$base_url}&serial_page={$page_next}'> > </a></li>";
        $last = "<li><a href='{$base_url}&serial_page={$total_pages}'> >> </a></li>";
        $links .= $next . $last;
    }
    $links .= "</ul>";
    return $links;
}

function countRowsInTable($catid)
{
    if ($catid == 0) {
        $sql = "SELECT count(*) FROM `product` WHERE prostock>0";
    } else
        $sql = "SELECT count(*) FROM `product` WHERE catid='{$catid}' AND prostock>0";
    global $conn;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count(*)'];
    return $count;
}
