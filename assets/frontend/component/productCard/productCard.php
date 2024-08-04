<!--Table category-->
<div class="container-product">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <?php
    $category_number = isset($_GET['category']) ? (int)$_GET['category'] : 0;
    require('../../../../db/connect.php');
    if ($category_number != 0) {
        $sql = "SELECT * FROM product where catid = $category_number";
    } else {
        $sql = "SELECT * FROM product";
    }
    $listProducts = $conn->query($sql);
    ?>
    <div id="category">
        <h3><?php
            $category = "SELECT * FROM category where catid = $category_number";
            $listCategory = $conn->query($category);
            $row = $listCategory->fetch_assoc();
            echo $row['catname'];
            ?></h3>
    </div>
    <div id="show-products">
        <?php
        while ($row = $listProducts->fetch_assoc()) {
        ?>
            <div class="product">
                <a href="../../pages/producInfo/productInfo.php?prodID=<?php echo $row['proid'] ?>">
                    <div class="show-thumbnail">
                        <img class="thumbnail-product" src="../../../UploadImage/<?php echo htmlspecialchars($row['image_path']); ?>" alt="type" />
                    </div>
                    <div class="info">
                        <ul>
                            <li class="pro-name"><?php echo $row['proname']; ?></li>
                            <li class="pro-origin">Xuất xứ:
                                <?php echo $row['productOrigin']; ?>
                            </li>
                            <li id="pro_price">
                                Giá: <script>
                                    var price = <?php echo $row['proprice'] ?>;
                                    document.write(nf.format(price));
                                </script>đ
                            </li>
                            <li class="pro-stock">Tình trạng:
                                <?php if ($row['prostock'] > 0) {
                                    echo "Còn hàng";
                                } else {
                                    echo "Tạm hết hàng";
                                }; ?>
                            </li>
                        </ul>
                    </div>
                </a>
                <div class="love-product">
                    <svg id="love-btn-<?php echo $row['proid']; ?>" onclick="fillColor(<?php echo $row['proid']; ?>)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                </div>
            </div>
        <?php
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