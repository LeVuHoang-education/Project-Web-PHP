<!--Table category-->
<div class="container-product">
    <div id="category">BÀN TRÀ - BÀN ĂN - BÀN LÀM VIỆC</div>
    <div id="show-products">
        <?php
        $category_number = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        require('../../../../db/connect.php');
        if ($category_number != 0) {
            $sql = "SELECT * FROM product where catid = $category_number";
        } else {
            $sql = "SELECT * FROM product";
        }
        $listProducts = $conn->query($sql);
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
                                <?php echo $row['proprice']; ?>
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
            </div>
        <?php
        }
        ?>
    </div>
</div>