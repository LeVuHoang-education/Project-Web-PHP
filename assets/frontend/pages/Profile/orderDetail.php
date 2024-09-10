<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/orderDetail.css">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
</head>

<body>
    <div class="order-detail-container">
        <div class="order-detail-content">
            <table id="table-field">
                <tr>
                    <th style="width:10%">Mã sản phẩm</th>
                    <th style="width:30%;">Sản phẩm</th>
                    <th style="width:20%;">Số lượng</th>
                    <th style="width:40%;">Tổng tiền</th>
                </tr>
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT `order-detail`.*,product.proname FROM `order-detail` INNER JOIN product ON `order-detail`.proid = product.proid WHERE `order-detail`.orderid = $id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <tr>
                                <td><?= $row['proid'] ?></td>
                                <td style="text-align:center;">
                                    <?php
                                    $id = $row['proid'];
                                    $query = "SELECT image_path FROM product WHERE proid=$id";
                                    $data = $conn->query($query);
                                    $row_image = $data->fetch_assoc();
                                    ?>
                                    <img id="thumbnail" src=<?= $row_image['image_path'] ?>>
                                    <p><?= $row['proname'] ?></p>
                                </td>
                                <td><?= $row['quanitity'] ?></td>
                                <td>
                                    <script>
                                        var price = <?= $row['price'] ?>;
                                        document.write(nf.format(price));
                                    </script>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
            </table>
        <?php
                    } else { ?>
            </table>
            <p>Chưa có gì ở đây cả. Hãy mua sắm ngay!</p>
    <?php
                    }
                }
    ?>
        </div>
    </div>
</body>

</html>