<?php
require_once __DIR__ . "../../../../../db/connect.php";
include_once __DIR__ . "../../../../../frontend/pages/Function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_cart_ids']) && !empty($_POST['selected_cart_ids'])) {

        $selectedItems = explode(',', $_POST['selected_cart_ids']);
    }
}

//lay data khach hang
if (isset($_SESSION['user_id'])) {
    $data_user = getUserbyID($_SESSION['user_id']);
    $data_dc = getDC($_SESSION['user_id']);
    $data_nh = getNhbyID($_SESSION['user_id']);
    $data_tt = getTTKH($_SESSION['user_id']);

    $ten = $data_tt->fetch_assoc()['fullname'];
    $sdt = $data_user->fetch_assoc()['phonenumber'];

    while ($row = $data_dc->fetch_assoc()) {
        if ($row['defaultDC'] == 1) {
            $dc = $row['address'] . ', ' . $row['city'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/frontend/pages/Checkout/Checkout.css">
    <script>
        var nf = Intl.NumberFormat();
    </script>
    <title>Document</title>
</head>

<body>
    <div class="DCNH">
        <div class="DCNH-header">
            <img src="assets/frontend/img/Icon/icons8-location-50.png" alt="">
            <h1>Địa chỉ nhận hàng</h1>
        </div>

        <div class="DCNH-content">
            <span><?php echo $ten ?></span>
            <span><?php echo $sdt ?></span>
            <span><?php echo $dc ?></span>
        </div>
    </div>

    <table class="checkout">
        <tr class="content-header">
            <th colspan="2">Sản phẩm</th>
            <th>Đơn giá </th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach ($selectedItems as $item){
            $items = getItembyCartID($item);
            $row = $items->fetch_assoc();
        ?>
            <tr class="content-main">
                <td> <img src="../../../UploadImage/<?php echo $row['image_path'] ?>" alt=""></td>
                <td><?php echo $row['proname'] ?></td>
                <td>
                    <script>
                        document.write(nf.format(<?php echo $row['itemprice'] ?>));
                    </script>
                </td>
                <td><?php echo $row['quantity'] ?></td>
                <td>
                    <script>
                        document.write(nf.format(<?php echo ($row['quantity'] * $row['itemprice']) ?>));
                    </script>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="DatHang">
        <div class="pttt-checkout">
            <label for="">Chọn phương thức thanh toán: </label>
            <select name="payment_status" id="paymentSelect" onchange="updateHiddenInput()">
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<option selected value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>';
                    echo '<option value="Tài khoản ngân hàng">Tài khoản ngân hàng</option>';
                } else {
                    echo '<option disabled value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>';
                } ?>
            </select>
        </div>
        <div class="totalmount">
            <span>Tổng tiền:</span>
            <span>
                <script>
                    var total = 0;
                    <?php foreach ($selectedItems as $item) {
                        $items = getItembyCartID($item);
                        $row = $items->fetch_assoc();
                    ?>
                        total += <?php echo ($row['quantity'] * $row['itemprice']) ?>;
                    <?php } ?>
                    document.write(nf.format(total));
                </script>
            </span>
        </div>
        <form action="../../../../frontend/pages/MuaHang.php" method="post">
            <input type="hidden" name="cartid" id="" value="<?php echo $_POST['selected_cart_ids'] ?>">
            <input type="hidden" name="pttt" id="paymentHiddenInput" value="">
            <input type="submit" value="Đặt hàng" name="Buy">
        </form>
    </div>

    <script>
        function updateHiddenInput() {
            var selectElement = document.getElementById('paymentSelect');
            var hiddenInput = document.getElementById('paymentHiddenInput');
            hiddenInput.value = selectElement.value;
        }
    </script>
</body>

</html>