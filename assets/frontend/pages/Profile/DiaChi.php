<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/DiaChi.css">
    <title>Document</title>
</head>

<body>
    <!-- ?php
    include __DIR__ .  "../../../../../frontend/pages/Function.php";
    $apiUrl = 'https://esgoo.net/api-tinhthanh/1/0.htm';
    $dataTP = fetchDataFromAPi($apiUrl);
    ?> -->
    <div class="bank-connection">
        <div class="bank-header">
            <h3>Địa chỉ của tôi</h3>
        </div>
        <hr class="line">
        <div class="bank-content">
            <div class="bank-list">
                <?php
                $id = $_SESSION['user_id'];
                $sql = "SELECT * FROM `dckh` WHERE userid=$id";
                $result = $conn->query($sql);

                if ($result->num_rows == 0) { ?>
                    <div class="empyt">
                        Bạn chưa có địa chỉ nào để giao hàng.
                    </div>
                <?php } else { ?>
                    <form name="address" id="address-field" method="post" action="frontend/pages/setDefaultAddress.php">
                        <?php
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            $count++;
                        ?>
                            <div class="address-item">
                                <div class="address">Địa chỉ <?php $address = " " . $count . ": " . $row['number_house'] . ", " . $row['ward'] . ", " . $row['district'] . ", " . $row['city'];
                                                                echo $address;  ?></div>
                                <input type="radio" name="default" value=<?= $row['idDC'] ?> <?php if ($row['defaultDC'] == true) echo "checked";
                                                                                                else echo "unchecked"; ?>>
                                <?php if ($row["defaultDC"] == true) { ?>
                                    <input type="hidden" name="currentDefault" value="<?= $row['idDC'] ?>" />
                                <?php } ?>
                            </div>
                        <?php
                        } ?>
                        <div style="display:flex;justify-content:center;width:100%;">
                            <button id="btn-submit" type="submit">Đặt làm mặc định</button>
                        </div>
                    </form>
                <?php
                }
                ?>
                <hr class="line">
                <div id="submit">
                    <button id="btn" type="submit" onclick="showingLinkingForm()">Thêm địa chỉ mới</button>
                </div>
            </div>
            <div class="add-account-bank hidden">
                <form class="field-form" action="../../../../frontend/pages/Themdc.php" method="post">
                    <label for="city">Thành phố</label>
                    <div class="box-input">
                        <select id="city-name" name="city-name">
                            <option value="none">Chọn tỉnh/thành phố</option>
                        </select>
                    </div>

                    <label for="district">Quận / Huyện</label>
                    <div class="box-input">
                        <select id="district-name" name="district-name">
                            <option value="none">Chọn Quận/Huyện</option>
                        </select>

                    </div>
                    <label for="ward">Xã / phường / Thị Trấn</label>
                    <div class="box-input">
                        <select id="ward-name" name="ward-name">
                            <option value="none">Chọn Xã/Phường/Thị Trấn</option>
                        </select>
                    </div>
                    <label for="number-house">Số nhà + đường</label>
                    <div class="box-input">
                        <input type="text" id="number-house" name="number-house" required>
                    </div>
                    <div id="submit">
                        <button type="submit" value="ThemDC" name="ThemDC">Thêm địa chỉ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/frontend/js/effect.js"></script>
    <script src="assets/frontend/js/Address_local.js"></script>
</body>

</html>