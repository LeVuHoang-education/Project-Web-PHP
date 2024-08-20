<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/component/productCard/productCard.css">
    <link rel="stylesheet" href="assets/frontend/pages/home/home.css">
    <link rel="stylesheet" href="assets/frontend/component/footer/footer.css">
    <link rel="stylesheet" href="assets/frontend/pages/productInfo/productInfo.css">
    <link rel="stylesheet" href="assets/frontend/pages/productList/productList.css">
    <link rel="stylesheet" href="assets/frontend/pages/About/about.css">
    <link rel="stylesheet" href="assets/frontend/pages/Dichvu/DichVu.css">
    <link rel="stylesheet" href="assets/frontend/component/Item/item.css">
    <link rel="stylesheet" href="./assets/frontend/component/header/header.css" />

</head>

<body style="background-color: #EEEEEE;">
    <?php
    include_once "./assets/frontend/component/header/header.php";
    include_once "./frontend/global/variable.php";
    $minPrice = 0;
    $maxPrice = 0;
    ?>

    <div class="layout-container">

        <?php
        include_once "./db/connect.php";
        echo "<div class='content'>";
        if (isset($_GET['act'])) {
            switch ($_GET['act']) {
                case 'productList':
                    include "./assets/frontend/pages/productList/productList.php";
                    break;
                case 'productInfo':
                    include "./assets/frontend/pages/productInfo/productInfo.php";
                    break;
                case 'about':
                    include "./assets/frontend/pages/About/about.php";
                    break;
                case 'signIn':
                    include "./assets/frontend/pages/Form/signIn.php";
                    break;
                case 'signUp':
                    include "./assets/frontend/pages/Form/signUp.php";
                    break;
                case 'account':
                    include "./assets/frontend/pages/Profile/Profile.php";
                    break;
                case 'search':
                    include "./assets/frontend/pages/searchPage/searchPage.php";
                    break;
                case 'chinh-sach-ban-hang':
                    include "assets/frontend/pages/Dichvu/CSBH.php";
                    break;
                case 'giao-hang-va-lap-dat':
                    include "assets/frontend/pages/Dichvu/CSGHLD.php";
                    break;
                case 'chinh-sach-doi-tra':
                    include "assets/frontend/pages/Dichvu/CSDT.php";
                    break;
                case 'chinh-sach-bao-hanh':
                    include "assets/frontend/pages/Dichvu/CSBHBT.php";
                    break;
                case 'DieuKhoan':
                    include "assets/frontend/pages/Footer/DieuKhoan.php";
                    break;
                case 'GioHang':
                    include "assets/frontend/pages/Cart/Cart.php";
                    break;
                default:
                    include "./assets/frontend/pages/home/home.php";
                    break;
            }
        } else {

            include "./assets/frontend/pages/home/home.php";
        }

        echo "</div>";
        ?>
    </div>
    <?php
    include_once "./assets/frontend/component/Footer/footer.php";

    ?>
    <script src="./assets/frontend/component/header/header.js"></script>
</body>

</html