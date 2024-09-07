<div class="container-product">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <script src="assets/frontend/component/productCard/productCard.js"></script>
    <?php
    $category_number = isset($_GET['cat']) ? (int)$_GET['cat'] : $category;
    require_once('./db/connect.php');
    if ($category_number != 0) {
        if ($maxPrice != 0) {
            $sql = "SELECT * FROM product WHERE proprice BETWEEN $minPrice AND $maxPrice AND prostock>'0' ORDER BY catid = $category_number";
        } else $sql = "SELECT * FROM product WHERE catid = $category_number AND prostock>'0'";
    } else {
        if ($maxPrice != 0) {
            $sql = "SELECT * FROM `product` WHERE  (proprice BETWEEN $minPrice AND $maxPrice) AND (prostock>'0') ";
        } else $sql = "SELECT * FROM product WHERE prostock>'0' ";
    }

    $listProducts = $conn->query($sql);
    ?>
    <div id="category">
        <h3><?php
            if ($category_number != 0) {
                $category = "SELECT * FROM category where catid = $category_number";
            } else $category = "SELECT * FROM category";
            $listCategory = $conn->query($category);
            $row = $listCategory->fetch_assoc();
            ?></h3>
    </div>

    <div id="show-products">
        <?php
        while ($row = $listProducts->fetch_assoc()) {
            $_SESSION['proid'] = $row['proid'];
            include "./assets/frontend/component/Item/item.php";
        }
        ?>
    </div>
</div>