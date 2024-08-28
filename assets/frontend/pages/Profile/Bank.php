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
        <div class="bank-list">
                <?php
                $id = $_SESSION['user_id'];
                $sql = "SELECT * FROM `tknh` WHERE userid=$id";
                $result = $conn->query($sql);

                if ($result->num_rows == 0) { ?>
                    <div class="empyt">
                        Bạn chưa có tài khoản ngân hàng.
                    </div>
                <?php } else {
                    include_once "./frontend/pages/Function.php";
                    ?>
                    
                    <form name="address" id="address-field" method="post" action="frontend/pages/setDefaultAddress.php">
                        <?php
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            $count++;
                        ?>
                            <div class="address-item">
                                <div class="address"><?php $address = $count . ": " . $row['bank_name'] . ", ". $row['account_name'];
                                                                echo $address;  ?></div>
                                <input type="radio" name="default" value=<?= $row['idBank'] ?> <?php if ($row['defaultBank'] == true) echo "checked";
                                                                                                else echo "unchecked"; ?>>
                                <?php if ($row["defaultBank"] == true) { ?>
                                    <input type="hidden" name="currentDefault" value="<?= $row['idBank'] ?>" />
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
                    <button id="btn-add" type="submit" onclick="showingLinkingForm()">Thêm tài khoản mới</button>
                </div>
            </div>
            <div class="add-account-bank hidden">
                <form class="field-form" action="frontend/pages/ThemNh.php" method="POST">
                    <label for="name-bank">Tên ngân hàng</label>
                    <div class="box-input">
                        <select id="bank-name" name="bank-name">
                            <option value="none">Chọn ngân hàng</option>
                        </select>
                    </div>
                    <div class="field-form">
                        <label for="bank-long-name">Tên ngân hàng</label>
                        <div class="box-input">
                            <input type="text" id="bank-short-name" name="bank-short-name">
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="account-number">Số tài khoản</label>
                        <div class="box-input">
                            <input type="text" id="account-number" name="account-number" required>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="account-name">Tên tài khoản</label>
                        <div class="box-input">
                            <input type="text" id="account-name" name="account-name" required>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="exp-date">Ngày hết hạn</label>
                        <div class="box-input">
                            <input type="date" id="exp-date" name="exp-date" required>
                        </div>
                    </div>
                    <div class="field-form">
                        <label for="cvv-number">Số CVV</label>
                        <div class="box-input">
                            <input type="text" id="cvv-number" name="cvv-number" required>
                        </div>
                    </div>
                    <div id="submit">
                        <button id="btn-submit-bank" type="submit" name="add-account-bank">Thêm tài khoản</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/frontend/js/effect.js"></script>
    <script src="assets/frontend/js/Bank.js"></script>
</body>

</html>