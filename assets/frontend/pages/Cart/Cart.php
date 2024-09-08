<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "../../../../../frontend/pages/Function.php";
//ktra gio hang co ton tai ch
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['dataiGH'])) {
    $_SESSION['dataiGH'] = false;
}
if (isset($_SESSION['user_id']) && $_SESSION['dataiGH'] == false) {
    $cartData = getAllItemCart($_SESSION['user_id']);
    while ($row = $cartData->fetch_assoc()) {
        $idsp = $row['proID'];
        $name = $row['proname'];

        if ($row['sales'] == null) {
            $price = $row['itemprice'];
        } else {
            $price = $row['itemprice'] * (1 - $row['sales'] / 100);
        }
        $img = $row['image_path'];
        $quantity = $row['quantity'];

        $sp = [$idsp, $name, $quantity, $price, $img];
        $_SESSION['cart'][] = $sp;
    }
    $_SESSION['dataiGH'] = true; // Đánh dấu đã tải dữ liệu giỏ hàng
}


//xoa gio hang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delcart'])) {
        unset($_SESSION['cart']);
        if (isset($_SESSION['user_id'])) {
            delAllItemCart($_SESSION['user_id']);
        }
    }
}
//xoa sp
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['del'])) {
        $id = $_POST['Cart-item-id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item[0] == $id) {
                unset($_SESSION['cart'][$key]);
                if (isset($_SESSION['user_id'])) {
                    delItemCart($_SESSION['user_id'], $id);
                }
                break;
            }
        }
    }
}

//lay data tu form
if (isset($_POST['addcart'])) {
    $idsp = $_POST['idSP'];
    $name = $_POST['nameSP'];
    $price = $_POST['priceSP'];
    $img = $_POST['imgSP'];
    $quantity = 1;

    $checked = $_POST['mua'];
    //ktra xem co sp chua
    $is_exist = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item[0] == $idsp) {
            $is_exist = true;
            $item[2]++;
            if (isset($_SESSION['user_id'])) {
                updateQuantityItemCart($_SESSION['user_id'], $idsp, $item[2]);
            }
            break;
        }
    }
    if ($is_exist == false) {
        $sp = [$idsp, $name, $quantity, $price, $img, $checked];
        $_SESSION['cart'][] = $sp;
        if (isset($_SESSION['user_id'])) {
            themItemCart($_SESSION['user_id'], $idsp, $quantity, $price);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/pages/Cart/Cart.css">
    <script>

    </script>
</head>

<body>
    <table class="order-item">
        <tr class="CartHeader">
            <th>Chọn</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Chức năng</th>
        </tr>
        <?php
        $i = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $itemOrder) {
                $sql = "SELECT prostock, is_active FROM product WHERE proid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $itemOrder[0]);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                // Kiểm tra nếu sản phẩm không còn hoạt động hoặc hết hàng
                $isDisabled = $row['is_active'] == 0 || $row['prostock'] == 0;
        ?>
                <tr class="CartContent">
                    <td>
                        <input type="checkbox"
                            name="choose-order"
                            onchange="updateTotalmount()"
                            id="choose-order"
                            <?php if ($itemOrder[5] == 1) echo 'checked'; ?>
                            <?php if ($isDisabled) echo 'disabled'; ?>>
                    </td>
                    <td>
                        <img max-width="100%"
                            height="100px"
                            id="thumbnail" src="../../../../UploadImage/<?php echo htmlspecialchars($itemOrder[4]); ?>"
                            alt="Product Image">
                    </td>
                    <td>
                        <h4 class="CardName"><?php echo htmlspecialchars($itemOrder[1]); ?></h4>
                    </td>
                    <td class="price" data-price="<?php echo $itemOrder[3] ?>"></td>
                    <td>
                        <div class="soluong">
                            <button class="btn" onclick="giam(this)" <?php if ($isDisabled) echo 'disabled'; ?>>-</button>
                            <?php
                            $sql = "SELECT prostock FROM product where proid=$itemOrder[0]";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <input id="quantity"
                                data-item-id="<?php echo $itemOrder[0]; ?>"
                                type="number"
                                value="<?php echo htmlspecialchars($itemOrder[2]); ?>"
                                disabled
                                min="1"
                                max="<?php echo $row['prostock']; ?>"
                                onchange="updateTotal(this)">

                            <button class="btn" onclick="tang(this)" <?php if ($isDisabled) echo 'disabled'; ?>>+</button>
                        </div>
                        <div class="tb">
                            <?php
                            if ($isDisabled) {
                                echo '<span class="error-message">Sản phẩm này đã hết hàng.</span>';
                            }
                            ?>
                        </div>
                    </td>
                    <td class="ThanhTien" data-total="<?php echo ((float)$itemOrder[2] *  (float)$itemOrder[3]) ?>"></td>
                    <td>
                        <form action="index.php?act=GioHang" method="post">
                            <input type="hidden" name="Cart-item-id" value="<?php echo htmlspecialchars($itemOrder[0]); ?>">
                            <input type="submit" value="Xóa" name="del" class="btn-del">
                        </form>
                    </td>
                </tr>
        <?php
            }
        } else {

            echo "<tr><td colspan='7' class='TB'>Không có sản phẩm nào trong giỏ hàng</td></tr>";

            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';

            // $cartData = getAllItemCart($_SESSION['user_id']);
            // while ($row = $cartData->fetch_assoc()) {
            //     $idsp = $row['proID'];
            //     $name = $row['proname'];
            //     $price = $row['itemprice'];
            //     $img = $row['image_path'];
            //     $quantity = $row['quantity'];

            //     $sp = [$idsp, $name, $quantity, $price, $img];
            //     echo '<pre>';
            //     print_r($sp);
            //     echo '</pre>';
            // }
        }
        ?>

        <tr class="CartFooter">
            <th><input type="checkbox" name="choose-order" id="choose-all"></th>
            <th colspan="2">
                <form action="index.php?act=GioHang" method="post">
                    <input type="submit" class="btn-mua" value="Xóa tất cả sản phẩm" name="delcart">
                </form>
            </th>
            <th colspan="3">
                <div>Tổng tiền: <span id="totalamount">0</span></div>
            </th>
            <th>
                <form action="index.php?act=<?php
                                            if (isset($_SESSION['user_id'])) {
                                                echo "ThanhToan";
                                            } else {
                                                echo "ThanhToanGuest";
                                            } ?>" method="post" id="checkout-form">
                    <input class="btn-mua" type="submit" value="Mua hàng" name="checkout">
                </form>
            </th>
    </table>
</body>

</html>