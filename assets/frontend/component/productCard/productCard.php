<div class="container-product">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <?php
    include "frontend/global/variable.php";

    $category_number = isset($_GET['cat']) ? (int)$_GET['cat'] : $category;
    require('./db/connect.php');
    if ($category_number != 0) {
        if ($maxPrice != 0) {
            $sql = "SELECT * FROM product WHERE proprice BETWEEN $minPrice AND $maxPrice ORDER BY catid = $category_number";
        } else $sql = "SELECT * FROM product WHERE catid = $category_number";
    } else {
        if ($maxPrice != 0) {
            $sql = "SELECT * FROM product WHERE proprice BETWEEN $minPrice AND $maxPrice";
        } else $sql = "SELECT * FROM product";
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
            $ID = $row['proid'];
            include "./assets/frontend/component/Item/item.php";
        }
        ?>
    </div>
    <script>
        function fillColor(productId) {
            const svg = document.getElementById("love-btn-" + productId); // Construct the ID from the argument
            svg.style.fill = svg.style.fill === "red" ? "black" : "red";
            alert("Sản phẩm đã được thêm vào danh sách yêu thích");
        }
    </script>
</div>