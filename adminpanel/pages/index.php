<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin pages</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesadmin.css">
    
</head>

<body>

    <?php
    include "./adminHeader.php";
    ?>
    <div class="container-admin">
        <?php
        include "./adminSidebar.php";
        include_once "../../db/connect.php";
        echo "<div class='content'>";
        if(isset($_GET['act'])){
            switch ($_GET['act']) {
                case 'SanPham':
                    include "ProductList.php";
                    break;
                case 'DanhMuc':
                    include "Category.php";
                    break;
                case 'DonHang':
                    include "Order.php";
                    break;
                case 'TaiKhoan':
                    include "UserList.php";
                    break;
                case 'EditUser':
                    include "EditUser.php";
                    break;
                case 'ThemSanPham':
                    include "AddProduct.php";
                    break;
                case 'EditProduct':
                    include "EditProduct.php";
                    break;
                case 'ODetail':
                    include "OrderDetail.php";
                    break;
                case 'UpdateOD':
                    include "UpdateStatus.php";
                    break;
                default:
                    include "dashboard.php";
                    break;
            }
        }else{
            include "dashboard.php";
        }
            echo "</div>";
        ?>
    </div>
</body>

</html>