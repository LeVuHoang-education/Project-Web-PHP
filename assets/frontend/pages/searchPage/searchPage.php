<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/pages/searchPage/searchPage.css">
</head>

<body>
    <div class="search-container">
        <div class="notify">Bạn đang tìm kiếm bằng từ khóa
            <?php
            if (isset($_SESSION['keySearch'])) {
                echo $_SESSION['keySearch'];
            }
            ?></div>
    </div>
    <div class="search-content">
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
</body>

</html>