<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "../../../../../frontend/pages/Function.php";
//ktra gio hang co ton tai ch
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delcart'])) {
        unset($_SESSION['cart']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['del'])){
        $id = $_POST['Cart-item-id'];
        foreach($_SESSION['cart'] as $key => $item){
            if($item[0] == $id){
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
}
//lay data tu form
if (isset($_POST['addcart'])) {
    $id = $_POST['idSP'];
    $name = $_POST['nameSP'];
    $price = $_POST['priceSP'];
    $img = $_POST['imgSP'];
    $quantity = 1;
    //ktra xem co sp chua
    $is_exist = false;
    foreach ($_SESSION['cart'] as $item) {
        if ($item[0] == $id) {
            $is_exist = true;
            $item[3] += 1;
            break;
        }
    }
    if ($is_exist == false) {
        $sp = [$id, $name, $quantity, $price, $img];
        $_SESSION['cart'][] = $sp;
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
        var nf = new Intl.NumberFormat();
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
                $i++;
        ?>
                <tr class="CartContent">
                    <td>
                        <input type="checkbox" name="choose-order" id="choose-order">
                    </td>
                    <td>
                        <img max-width="100%" ; height="100px" id="thumbnail" src="../../../../UploadImage/<?php echo htmlspecialchars($itemOrder[4]); ?>" alt="Product Image">
                    </td>
                    <td>
                        <h4 class="CardName"><?php echo htmlspecialchars($itemOrder[1]); ?></h4>
                    </td>
                    <td>
                        <script>
                            document.write(nf.format(<?php echo htmlspecialchars($itemOrder[3]); ?>));
                        </script>
                    </td>
                    <td>
                        <div class="Q" onkeyup="tien(this)" contenteditable="true">
                            <button class="btn minus">-</button>
                            <input id="quantity" type="number" value="<?php echo htmlspecialchars($itemOrder[2]); ?>" min="1">
                            <button class="btn plus">+</button>
                        </div>
                    </td>
                    <td>
                        <div class=""></div>
                    </td>
                    <td>
                        <form action="index.php?act=GioHang" method="post">
                            <input type="hidden" name="Cart-item-id" value="<?php echo htmlspecialchars($itemOrder[0]);?>">
                            <input type="submit" value="Xóa" name="del">
                        </form>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='TB'>Không có sản phẩm nào trong giỏ hàng</td></tr>";
        }
        ?>
        <tr class="CartFooter">
            <th><input type="checkbox" name="choose-order" id="choose-order"></th>
            <th colspan="2">
                <form action="index.php?act=GioHang" method="post">
                    <input type="submit" value="Xóa giỏ hàng" name="delcart">
                </form>
            </th>
            <th colspan="3">
                <div id="totalmount">Tổng tiền: </div>
            </th>
            <th>
                <a href="#">Mua hàng</a>
            </th>
        </tr>
    </table>
    <script src="assets/frontend/pages/Cart/Cart.js"></script>
</body>

</html>