<?php
    include __DIR__ . '../../../../../frontend/pages/Function.php';
    $apiUrl = "https://api.vietqr.io/v2/banks";
    $dataNH = fetchDataFromAPi($apiUrl);
?>

<div id="modal_themNH" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="modal3">&times;</span>
        <h2>Thêm ngân hàng </h2>
        <form action="../../../../frontend/pages/ThemNh.php" method="post">
            <div class="input-groupNH">
                <label for="bank_name">Tên ngân hàng</label>
                <select name="bank_name" id="">
                <?php foreach ($dataNH['data'] as $bank) { ?>
                    <option value="<?php echo $bank['name']; ?>"><?php echo $bank['name']. " - " .$bank['code']; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="input-groupNH">
                <label for="stk">Số tài khoản</label>
                <input type="text" id="stk" name="account_number" required>
            </div>
            <div class="input-groupNH">
                <label for="ngayhethan">Ngày hết hạn</label>
                <input type="date" id="ngayhethan" name="expiration_date" required>
                <label for="cvv">Mã cvv</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <div class="input-groupNH">
                <label for="hoten">Họ và tên chủ thẻ</label>
                <input type="text" id="HoTen" name="account_name" required>
            <div class="input-groupNH">
                <button type="submit" class="btn" name="ThemNH" value="ThemNH">Thêm</button>
            </div>
        </form>
    </div>
</div>  