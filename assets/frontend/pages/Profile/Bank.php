<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/Bank.css">
    <title>Document</title>
</head>

<body>
    <div class="bank-connection">
        <div class="bank-header">
            <h3>Tài khoản ngân hàng của tôi</h3>
        </div>
        <hr class="line">
        <div class="bank-content">

            <div class="bank-list empty"> Bạn chưa có tài khoản ngân hàng.
                <hr class="line">
                <div id="submit">
                    <button id="btn" type="submit" onclick="showingLinkingForm()">Thêm liên kết</button>
                </div>
            </div>
            <div class="add-account-bank hidden">
                <form class="field-form">
                    <label for="name-bank">Tên ngân hàng</label>
                    <div class="box-input">
                        <select id="name-bank" name="name-bank">
                            <option value="none">Chọn ngân hàng</option>
                        </select>
                    </div>
                    <div class="field-form">
                        <label for="account-number">Số tài khoản</label>
                        <div class="box-input">
                            <input type="text" id="account-number" name="account-number" required>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="card-ID">Mã số thẻ</label>
                        <div class="box-input">
                            <input type="text" id="card-number" name="card-number" required>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="card-type">Loại tài khoản</label>
                        <div class="box-input">
                            <select id="card-type" name="card-type">
                                <option value="none">---</option>
                                <option value="napas">Thẻ NAPAS</option>
                                <option value="visa">Thẻ VISA</option>
                                <option value="vip">Thẻ VIP</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div id="submit">
                    <button type="submit">Thêm tài khoản</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/frontend/js/effect.js"></script>
    <script src="assets/frontend/js/Bank.js"></script>
</body>

</html>