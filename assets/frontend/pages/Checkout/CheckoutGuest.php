<?php
// echo "<pre>";
// print_r($_SESSION);
// //print_r($_POST);
// echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_cart_ids']) && !empty($_POST['selected_cart_ids'])) {
        $selectedItems = explode(',', $_POST['selected_cart_ids']);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/frontend/pages/Checkout/CheckoutGuest.css">
    <script>
        var nf = Intl.NumberFormat();
    </script>
    <title>Document</title>
</head>

<body>
    <div class="DCNH">
        <div class="DCNH-header">
            <img src="assets/frontend/img/Icon/icons8-add-properties-50.png" alt="">
            <h1>Thông tin nhận hàng</h1>
        </div>
        <?php if (!isset($_SESSION['guest_id'])) { ?>

            <form id="form1" action="../../../../frontend/pages/ThemDataGuest.php" method="post" class="DCNH-content">
                <div class="inputbox">
                    <label for="">Họ và Tên</label>
                    <div class="inputtype">
                        <img src="assets/frontend/img/Icon/icons8-name-tag-64.png" alt="">
                        <input type="text" name="guestname" placeholder="Nhập họ và tên" required>
                    </div>
                </div>
                <div class="inputbox">
                    <label for="">Số điện thoại</label>
                    <div class="inputtype">
                        <img src="assets/frontend/img/Icon/icons8-phone-number-100.png" alt="">
                        <input type="text" name="guestphone" placeholder="Nhập số điện thoại" required>
                    </div>
                </div>
                <div class="inputbox">
                    <label for="">Địa chỉ</label>
                    <div class="inputtype">
                        <img src="assets/frontend/img/Icon/icons8-address-100.png" alt="">
                        <input type="text" name="guestaddress" placeholder="Nhập địa chỉ nhận hàng" required>
                    </div>
                </div>
                <div class="inputbox">
                    <label for="">Email</label>
                    <div class="inputtype">
                        <img src="assets/frontend/img/Icon/icons8-email-100.png" alt="">
                        <input type="email" name="guestmail" placeholder="Nhập email" required>
                    </div>
                </div>
            </form>

        <?php } ?>
    </div>

    <table class="checkout">
        <tr class="content-header">
            <th colspan="2">Sản phẩm</th>
            <th>Đơn giá </th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach ($selectedItems as $item) {
            foreach ($_SESSION['cart'] as $sessionItem) {
                if ($sessionItem[0] == $item) {
                    $price = floatval($sessionItem[3]);
                    $quantity = floatval($sessionItem[2]);
                    $total = $price * $quantity;
        ?>
                    <tr class="content-main">
                        <td> <img src="../../../UploadImage/<?php echo htmlspecialchars($sessionItem[4]) ?>" alt=""></td>
                        <td><?php echo $sessionItem[1] ?></td>
                        <td>
                            <script>
                                document.write(nf.format(<?php echo $price ?>));
                            </script>
                        </td>
                        <td><?php echo $sessionItem[2] ?></td>
                        <td>
                            <script>
                                document.write(nf.format(<?php echo $total ?>));
                            </script>
                        </td>
                    </tr>
        <?php }
            }
        } ?>
    </table>
    <div class="DatHang">
        <div class="pttt-checkout">
            <label for="">Chọn phương thức thanh toán: </label>
            <select name="payment_status" id="paymentSelect" onchange="updateHiddenInput()">
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<option selected value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>';
                    echo '<option value="Tài khoản ngân hàng">Tài khoản ngân hàng</option>';
                } else {
                    echo '<option disabled selected value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>';
                } ?>
            </select>
        </div>
        <div class="totalmount">
            <span>Tổng tiền:</span>
            <span>
                <script>
                    var total = 0;
                    <?php foreach ($selectedItems as $item) {
                        foreach ($_SESSION['cart'] as $sessionItem) {
                            if ($sessionItem[0] == $item) {
                    ?>
                                total += <?php echo ($sessionItem[2] * $sessionItem[3]) ?>;
                    <?php }
                        }
                    } ?>
                    document.write(nf.format(total));
                </script>
            </span>
        </div>

        <form action="../../../../frontend/pages/MuaHangGuest.php" method="post" id="form2">
            <input type="hidden" name="cartid" id="" value="<?php echo $_POST['selected_cart_ids'] ?>">
            <input type="hidden" name="pttt" id="paymentHiddenInput" value="Thanh toán khi nhận hàng">
        </form>


        <button class="btn-dathang" onclick="submitForms()">Đặt hàng</button>
    </div>
    <script>
        function validateEmail(email) {

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        function submitForms() {
            var email = document.querySelector('input[name="guestmail"]').value;

            if (!validateEmail(email)) {
                alert("Email không hợp lệ. Vui lòng nhập địa chỉ email hợp lệ.");
                return;
            }


            var form1Data = new FormData(document.getElementById('form1'));

            fetch('../../../../frontend/pages/ThemDataGuest.php', {
                    method: 'POST',
                    body: form1Data
                })
                .then(response => response.text())
                .then(result => {

                    if (result.includes('Lỗi')) {
                        alert(result);
                        return;
                    }


                    var form2 = document.getElementById('form2');
                    form2.submit();
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra khi gửi dữ liệu.');
                });
        }
    </script>
</body>

</html>
<!-- <button id="submit-button" name="Buy" value="Đặt hàng" class="btn-dathang">Đặt hàng</button> -->