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
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `dckh` WHERE userid = $id";
    $data_dc = $conn->query($sql);
    $row = $data_dc->fetch_assoc();
    if ($row != null) {

        $data_dc = getDC($_SESSION['user_id']);
        $data_nh = getNhbyID($_SESSION['user_id']);
        $data_tt = getTTKH($_SESSION['user_id']);
        $data_user = getUserbyID($_SESSION['user_id']);


        if ($data_tt->num_rows > 0) {
            $ten = $data_tt->fetch_assoc()['fullname'];
        } else $ten = $data_user->fetch_assoc()['username'];

        $data_user = getUserbyID($_SESSION['user_id']);
        $sdt = $data_user->fetch_assoc()['phonenumber'];

        while ($row = $data_dc->fetch_assoc()) {
            if ($row['defaultDC'] == 1) {
                $dc = $row['number_house'] . ", " . $row['ward'] . ", " . $row['district'] . ", " . $row['city'];
            }
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
            <?php
            $id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `dckh` WHERE userid = $id";
            $data_dc = $conn->query($sql);
            $row = $data_dc->fetch_assoc();
            if ($row != null) {
            ?>
                <span><?php echo $ten ?></span>
                <span><?php echo $sdt ?></span>
                <span><?php echo $dc ?></span>
            <?php } else { ?>
                <span>Bạn chưa có địa chỉ nhận hàng (mặc định)</span>
            <?php } ?>
        </div>
    </div>

    <table class="checkout">
        <tr class="content-header">
            <th colspan="2">Sản phẩm</th>
            <th>Đơn giá </th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach ($selectedItems as $item) {
            foreach ($_SESSION['cart'] as $cartItem) {
                if ($cartItem[0] == $item) { ?>
                    <tr class="content-main">
                        <td> <img src="../../../UploadImage/<?php echo $cartItem[4] ?>" alt=""></td>
                        <td><?php echo $cartItem[1] ?></td>
                        <td>
                            <script>
                                document.write(nf.format(<?php echo $cartItem[3] ?>));
                            </script>
                        </td>
                        <td><?php echo $cartItem[2] ?></td>
                        <td>
                            <script>
                                document.write(nf.format(<?php echo ($cartItem[3] * $cartItem[2]) ?>));
                            </script>
                        </td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </table>
    <div class="DatHang">
        <div class="pttt-checkout">
            <label for="">Chọn phương thức thanh toán: </label>
            <select name="payment_status" id="paymentSelect" onchange="updateHiddenInput()">
                <?php if (isset($_SESSION['user_id'])) {
                    $id = $_SESSION['user_id'];

                    echo '<option selected value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>';
                    $sql = "SELECT defaultBank FROM `tknh` WHERE userid=$id AND defaultBank = '1'";
                    $data_bank = $conn->query($sql);
                    $row = $data_bank->fetch_assoc();
                    if ($row != null) {
                        echo '<option value="Tài khoản ngân hàng">Tài khoản ngân hàng</option>';
                    } else {
                        echo '<option value="Tài khoản ngân hàng" disabled>Tài khoản ngân hàng</option>';
                    }
                } else {
                    echo '<option disabled value="Thanh toán khi nhận hàng" selected>Thanh toán khi nhận hàng</option>';
                } ?>
            </select>
        </div>
        <div class="totalmount">
            <span>Tổng tiền:</span>
            <span>
                <script>
                    var total = 0;
                    <?php foreach ($selectedItems as $item) {
                        foreach ($_SESSION['cart'] as $cartItem) {
                            if ($cartItem[0] == $item) { ?>
                                total += <?php echo ($cartItem[2] * $cartItem[3]) ?>;

                    <?php }
                        }
                    } ?>
                    document.write(nf.format(total));
                </script>
            </span>
        </div>
        <form action="../../../../frontend/pages/MuaHang.php" method="post">
            <input type="hidden" name="cartid" id="" value="<?php echo $_POST['selected_cart_ids'] ?>">
            <input type="hidden" name="pttt" id="paymentHiddenInput" value="Thanh toán khi nhận hàng">
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