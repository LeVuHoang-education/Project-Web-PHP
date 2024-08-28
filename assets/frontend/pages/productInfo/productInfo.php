<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <title>Thông tin sản phẩm</title>
</head>

<body>
    <?php
    $id = isset($_GET['prodID']) ? ($_GET['prodID']) : 27;

    $sql = "SELECT * FROM product where proid=$id";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); { ?>
        <div class="container">
            <div class="product-info">
                <div class="product-image">
                    <img class="image" src="../../../<?php echo htmlspecialchars($row['image_path']); ?>">
                </div>
                <div class="product-intro">
                    <div class="show-info">
                        <div class="product-name">
                            <?php echo $row['proname']; ?>
                        </div>
                        <div class="product-origin">
                            <h4>Xuất xứ:<?php echo $row['productOrigin'] ?></h4>
                        </div>
                        <div class="product-price">Giá: <script>
                                var price = <?php echo $row['proprice'] ?>;
                                document.write(nf.format(price));
                            </script>đ</div>
                        <div class="product-description"><?php
                                                            $lines = explode("\n", $row['prodescription']);
                                                            foreach ($lines as $line) {
                                                                echo "<p>" . $line . "</p>";
                                                            }
                                                            ?></div>
                    </div>
                    <div class="act">
                        <div class="btn">
                            <button class="order-btn" <?php
                                                        if ($row['prostock'] == 0) {
                                                            echo "disabled";
                                                        }
                                                        ?>>
                                <span>
                                    <a href="../../../../index.php?act=shopping">
                                        Mua ngay
                                    </a>
                                </span>
                            </button>
                            <form id="form-add-cart" action="../../../../index.php?act=GioHang" method="post">
                                <input type="hidden" name="idSP" value="<?php echo $id ?> ">
                                <input type="hidden" name="nameSP" value=" <?php echo $row['proname']; ?>">
                                <input type="hidden" name="priceSP" value="<?php echo $row['proprice'] ?>">
                                <input type="hidden" name="imgSP" value="<?php echo htmlspecialchars($row['image_path']); ?>">
                                <input type="submit" class="pre-order-btn" name="addcart" value="Thêm vào giỏ" <?php
                                                                                                                if ($row['prostock'] == 0) {
                                                                                                                    echo "disabled";
                                                                                                                }
                                                                                                                ?>>
                            </form>
                        </div>
                        <div class="hotline">Gọi ngay để được tư vấn:<br /> 01234567890</div>
                    </div>
                </div>
            </div>
            <div class="decription"></div>
        </div>

    <?php
    }
    ?>
</body>

</html>