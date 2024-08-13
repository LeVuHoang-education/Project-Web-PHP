<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/DiaChi.css">
    <title>Document</title>
</head>

<body>
    <?php
    include __DIR__ .  "../../../../../frontend/pages/Function.php";
    $apiUrl = 'https://esgoo.net/api-tinhthanh/1/0.htm';
    $dataTP = fetchDataFromAPi($apiUrl);
    ?>
    <div class="bank-connection">
        <div class="bank=header">
            <h3>Địa chỉ của tôi</h3>
        </div>
        <hr class="line">
        <div class="bank-content">

            <div class="bank-list empty"> Bạn chưa có địa chỉ nào để giao hàng.
                <hr class="line">
                <div id="submit">
                    <button id="btn" type="submit" onclick="showingLinkingForm()">Thêm địa chỉ mới</button>
                </div>
            </div>
            <div class="add-account-bank hidden">
                <form class="field-form" action="fontend/pages/Themdc.php" method="post">
                    <label id="city-name">Thành phố</label>
                    <div class="box-input">
                        <select id="city-name" name="city-name">
                            <option value="">Chọn tỉnh/thành phố</option>
                            <?php foreach ($dataTP['data'] as $tp) : ?>
                                <option value="<?php echo $tp['name']; ?>"><?php echo $tp['name']; ?></option>
                            <?php endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="field-form">
                        <label for="account-number">Quận / Huyện</label>
                        <div class="box-input">
                            <select id="name-bank" name="name-bank">
                                <option value="none">---</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="card-ID">Xã / phường / Thị Trấn</label>
                        <div class="box-input">
                            <select id="card-type" name="card-type">
                                <option value="none">---</option>
                            </select>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="card-type">Số nhà + đường</label>
                        <div class="box-input">
                            <input type="text" id="card-number" name="card-number" required>
                        </div>
                    </div>
                </form>
                <div id="submit">
                    <button type="submit">Thêm tài khoản</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/frontend/js/Bank.js"></script>
</body>

</html>