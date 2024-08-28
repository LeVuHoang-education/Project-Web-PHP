<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <script src="./assets/frontend/component/Item/item.js"></script>
</head>

<body>
    <?php
    include "db/connect.php";
    include "frontend/global/variable.php";
    $sql = "SELECT * FROM product WHERE proid = $ID";
    $info = $conn->query($sql);
    $row = $info->fetch_assoc();

    ?>
    <div class="product">
        <a href="../../../../index.php?act=productInfo&prodID=<?php echo $row['proid'] ?>">
            <div class="show-thumbnail">
                <img class="thumbnail-product" src="../../../UploadImage/<?php echo htmlspecialchars($row['image_path']); ?>" alt="type" />
            </div>
            <div class="info">
                <ul>
                    <li class="pro-name"><?php echo $row['proname']; ?></li>
                    <li id="pro_price">
                        <?php if ($row['sales'] == null) { ?>
                            Giá: <script>
                                var price = <?php echo $row['proprice'] ?>;
                                document.write(nf.format(price));
                            </script>đ
                        <?php } else { ?>
                            <div class="old-price" style="color:gray; text-decoration:line-through">
                                Giá cũ: <script>
                                    var price = <?php echo $row['proprice'] ?>;
                                    document.write(nf.format(price));
                                </script>đ
                            </div>
                            <div class="new-price" style="color:red;">
                                Giá mới: <script>
                                    var price = <?php echo $row['proprice'] * ($row['sales'] / 100) ?>;
                                    document.write(nf.format(price));
                                </script>đ
                            </div>
                        <?php
                        } ?>
                    </li>
                    <li class="pro-stock" style="color: <?php echo ($row['prostock'] > 0) ? "green" : "red"; ?>;">Tình trạng:
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
            <form action="../../../../index.php?act=GioHang" method="post">
                <input type="hidden" name="idSP" value="<?php echo $row['proid'] ?> ">
                <input type="hidden" name="nameSP" value=" <?php echo $row['proname']; ?>">
                <input type="hidden" name="priceSP" value="<?php echo $row['proprice'] ?>">
                <input type="hidden" name="imgSP" value="<?php echo htmlspecialchars($row['image_path']); ?>">
                <button class="add-product" name="addcart" type="submit" onclick="addProduct(<?php echo $row['proid']; ?>)">
                    <svg id="love-btn-<?php echo $row['proid']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</body>

</html>