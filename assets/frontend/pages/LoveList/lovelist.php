<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <title>Danh sách yêu thích</title>
</head>

<body>
    <div class="lovelist-container">
        <div class="lovelist-content">
            <table>
                <tr>
                    <th colspan="5">Sản phẩm yêu thích</th>
                </tr>
                <tr>
                    <th id="prodID">ID</th>
                    <th id="prodInfo">Thông tin sản phẩm</th>
                    <th id="prodprice">Giá</th>
                    <th id="action">Hành động</th>
                </tr>
                <?php
                if (isset($_SESSION['lovelist'])) {
                    $list = $_SESSION['lovelist'];
                    foreach ($list as $id) {
                        $sql = "SELECT proid, proname, proprice,image_path, sales FROM `product` WHERE proid=$id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                ?>
                        <tr id="row-<?= $row['proid']; ?>">
                            <td id="prodID"><?= $row['proid']; ?></td>
                            <td id="prodInfo">
                                <div class="prodInfo">
                                    <div class="prodImage">
                                        <img id="thumbnail-product" src="<?= $row['image_path'] ?>" />
                                    </div>
                                    <div class="prodName">
                                        <a id="btn-watch" href="../../../../index.php?act=productInfo$prodID=<?= $row['proid']; ?>">
                                            <?= $row['proname']; ?>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td id="prodprice">
                                <script>
                                    var price = <?php
                                                if ($row['sales'] == null) {
                                                    echo $row['proprice'];
                                                } else {
                                                    echo $row['proprice'] - ($row['proprice'] * ($row['sales'] / 100));
                                                } ?>;
                                    document.write(nf.format(price));
                                </script>

                            </td>
                            <td id="action">
                                <div class="btns-action">
                                    <div class="btn-act-buy">
                                        <form action="../../../../index.php?act=GioHang" method="post">
                                            <input type="hidden" name="idSP" value="<?php echo $row['proid'] ?> ">
                                            <input type="hidden" name="nameSP" value=" <?php echo $row['proname']; ?>">
                                            <input type="hidden" name="priceSP" value="<?php
                                                                                        if ($row['sales'] == null) {
                                                                                            echo $row['proprice'];
                                                                                        } else {
                                                                                            echo $row['proprice'] - ($row['proprice'] * ($row['sales'] / 100));
                                                                                        } ?>">
                                            <input type="hidden" name="imgSP" value="<?php echo htmlspecialchars($row['image_path']); ?>">
                                            <input type="hidden" name="mua" id="" value="1">
                                            <button type="submit" class="btn-buy" name="addcart" value="Mua ngay">Mua ngay</button>
                                        </form>
                                    </div>
                                    <div class="btn-act-delete">
                                        <button class="btn-delete" onclick="revLoveProduct(<?= $row['proid'] ?>)">Xóa</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <script src="./assets/frontend/pages/LoveList/lovelist.js"></script>
</body>

</html>