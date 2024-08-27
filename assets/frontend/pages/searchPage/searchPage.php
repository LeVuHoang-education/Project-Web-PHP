<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/pages/searchPage/searchPage.css">
    <script src="assets/frontend/pages/searchPage/searchPage.js"></script>
    <title>Tìm kiếm</title>
</head>

<body>
    <div class="search-container">
        <div class="notify">Bạn đang tìm kiếm bằng từ khóa
            <?php
            if (isset($_SESSION['keySearch'])) {
                echo " ' " . $_SESSION['keySearch'] . " ' ";
            }
            ?></div>
    </div>
    <div class="search-content">
        <div class="search-by-range">
            <form id="form-field-range" action="frontend/pages/searchItems.php" method="POST">
                <label for="search-by-range">Tìm kiếm theo khoảng giá:</label>
                <div class="show-range">
                    <div class="show-content">
                        <label>Từ</label>
                        <div id="min">
                            <input type="range" name="min-range" id="min-range" min="0" max="50000000" value=0 step="1000" oninput="changeValue()">
                            <div id="min-value">0</div>
                        </div>
                    </div>
                    <div class="show-content">
                        <label>Đến</label>
                        <div id="max">
                            <input type="range" name="max-range" id="max-range" min="0" max="50000000" value=50000000 step="1000" oninput="changeValue()">
                            <div id="max-value">50000000</div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="key_search" value="<?= $_SESSION['keySearch']; ?>">
                <button id="btn-search" type="submit" onclick=" return  checkValue()">Lọc sản phẩm</button>
            </form>
        </div>
        <div class="search-results">
            <?php
            if (isset($_SESSION["itemList"])) {
                include "frontend/global/variable.php";
                foreach ($_SESSION['itemList'] as $itemID) {
                    $ID = $itemID;
                    include 'assets/frontend/component/Item/item.php';
                }
            }
            ?>
        </div>
    </div>
    <script>
        var minRange = document.getElementById("min-range");
        var maxRange = document.getElementById("max-range");

        var minValue = document.getElementById("min-value");
        var maxValue = document.getElementById("max-value");

        minRange.value = "<?= $_SESSION['minValue'] ?>";
        maxRange.value = "<?= $_SESSION['maxValue'] ?>";

        var nf = new Intl.NumberFormat();

        minValue.textContent = "<?php echo $_SESSION['minValue'] ?>";
        maxValue.textContent = "<?php echo $_SESSION['maxValue'] ?>";
    </script>
    <?php
    unset($_SESSION['minValue']);
    unset($_SESSION['maxValue']);
    ?>
</body>

</html>