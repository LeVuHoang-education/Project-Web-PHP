<!--Table category-->
<div class="container-product">
    <div id="category">BÀN TRÀ - BÀN ĂN - BÀN LÀM VIỆC</div>
    <div id="show-products">
        <?php
        $category_number = 0;
        if (isset($_POST['$cat_number'])) {
            $category_number = $_POST['cat_number'];
        }

        require('../../../../db/connect.php');
        if ($category_number != 0) {
            $sql = "SELECT * FROM product where cat_id = $category_number";
        } else {
            $sql = "SELECT * FROM product";
        }
        $listProducts = $conn->query($sql);
        while ($row = $listProducts->fetch_assoc()) {
        ?>
            <div class="product">
                <a href="./product.html">
                    <div class="show-thumbnail">
                        <img class="thumbnail-product" src="../../../UploadImage/<?php echo htmlspecialchars($row['image_path']) ?>" alt="type" />
                    </div>
                    <div class="info">
                        <ul>
                            <li><?php echo $row['proname']; ?></li>
                            <li>Type:
                                <?php if ($row['catid'] == 4) {
                                    echo "Table";
                                } else if ($row['catid'] == 3) {
                                    echo "Chair";
                                }; ?>
                            </li>
                            <li>
                                <?php echo $row['proprice']; ?>
                            </li>
                            <li>Status:
                                <?php if ($row['prostock'] > 0) {
                                    echo "Okay";
                                } else {
                                    echo "Sold out";
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