<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-product">
        <script>
            var nf = new Intl.NumberFormat();
        </script>
        <script src="assets/frontend/component/productCard/productCard.js"></script>
        <?php
        $category_number = isset($_GET['cat']) ? (int)$_GET['cat'] : $category;
        require_once('./db/connect.php');
        include_once('./frontend/pages/Function.php');

        //thiet lap cac thong so phan tran
        //$page_size: kich thuoc trang (o day la so luong item)
        //$serial_page: so thu tu trang
        $page_size = 10;
        $serial_page = 1;
        $offset = 3;
        if (isset($_GET['serial_page'])) {
            $serial_page = (int) $_GET['serial_page'];
        }
        if ($serial_page <= 0) $serial_page = 1;

        $startRow = ($serial_page - 1) * $page_size;

        if ($category_number != 0) {
            if ($maxPrice != 0) {
                $sql = "SELECT * FROM product WHERE proprice BETWEEN $minPrice AND $maxPrice AND prostock>'0' AND is_active='1'  LIMIT $startRow,$page_size ORDER BY catid = $category_number";
            } else $sql = "SELECT * FROM product WHERE catid = $category_number AND prostock>'0' AND is_active='1' LIMIT $startRow,$page_size";
        } else {
            if ($maxPrice != 0) {
                $sql = "SELECT * FROM `product` WHERE  (proprice BETWEEN $minPrice AND $maxPrice) AND (prostock>'0') AND is_active='1' LIMIT $startRow,$page_size";
            } else {
                $sql = "SELECT * FROM product WHERE prostock>'0' AND is_active='1' LIMIT $startRow,$page_size";
            }
        }

        $listProducts = $conn->query($sql);
        ?>

        <?php
        if ($category_number != 0) {
            $category = "SELECT * FROM category where catid = $category_number";
        } else $category = "SELECT * FROM category";
        $listCategory = $conn->query($category);
        $row = $listCategory->fetch_assoc();
        ?>

        <div id="show-products">
            <?php
            while ($row = $listProducts->fetch_assoc()) {
                $_SESSION['proid'] = $row['proid'];
                include "./assets/frontend/component/Item/item.php";
            }
            ?>
        </div>
        <?php

        $base_url = "../../../../index.php?act=productList&cat=" . $category_number;
        $total_rows = countRowsInTable($category_number);
        echo createPagination($base_url, $total_rows, $serial_page, $page_size, $offset);
        ?>
    </div>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            list-style-type: none;
        }

        ul.pagination li {
            margin: 0 10px;
            width: 30px;
            height: 30px;
            background-color: var(--button-bg-color);
            border-radius: 5px;
        }

        ul.pagination li a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            text-align: center;
            text-decoration: none;
            color: black;
        }
    </style>
</body>

</html>