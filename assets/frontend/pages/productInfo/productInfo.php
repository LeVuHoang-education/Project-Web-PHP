<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../component/header/header.css" />
    <link rel="stylesheet" href="../../component/Footer/Footer.css" />
    <link rel="stylesheet" href="./productInfo.css" />
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <title>Thông tin sản phẩm</title>
</head>

<body>
    <?php include("../../component/header/header.php"); ?>
    <?php
    $id = isset($_GET['prodID']) ? ($_GET['prodID']) : 27;
    require('../../../../db/connect.php');
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
                            <button class="order-btn">Mua ngay</button>
                            <button class="pre-order-btn">Thêm vào giỏ</button>
                            <button class="review-btn">Đánh giá</button>
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
    <?php include("../../component/footer/footer.php"); ?>
</body>

</html>