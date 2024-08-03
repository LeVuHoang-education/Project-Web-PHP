<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/OrderDetail.css">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <title>OrderDetail</title>
</head>

<body>
    <div class="oD-con">
        <div class="formOD">
            <div class="card-Header">
                <h1> ID:
                    <?php if (isset($_GET['ID'])) {
                        $id = $_GET['ID'];
                    }
                    echo $id;
                    ?>
                </h1>
                <p>Chi tiết đơn hàng </p>
            </div>
            <hr class="vachOD">
            <div class="TieuDeOD">

                <div class="col-1"></div>
                <div class="col-2 TDSP"><b>
                        Sản phẩm
                    </b>
                </div>
                <div class="col-3 TDDG"> <b>Đơn giá</b></div>
                <div class="col-4 TDTT"><b> Thành tiền</b></div>
            </div>
            <?php
            require('../../db/connect.php');
            include('../../fontend/pages/Function.php');
            $item = getItembyID($id);
            while ($row = $item->fetch_assoc()) {
                $product = getProductbyID($row['proid']);
                $row1 = $product->fetch_assoc();
            ?>
                <div class="card-content">
                    <div class="imageItem col-1"> <img src="../../UploadImage/<?php echo $row1['image_path'] ?>" width="96px" height="96px" alt=""></div>
                    <div class="NameSL col-2">
                        <div><?php echo $row1['proname'] ?></div>
                        <br>
                        <div>Số lượng: <?php echo $row['quantity'] ?></div>
                    </div>
                    <div class="col-3">
                        <script>
                            var itemprice = <?php echo $row1['proprice'] ?>;
                            document.write(nf.format(itemprice) + "<sup>đ</sup>");
                        </script>
                    </div>
                    <div class="itemPrice col-4">
                        <script>
                            var itemprice = <?php echo $row['itemprice'] ?>;
                            document.write(nf.format(itemprice) + "<sup>đ</sup>");
                        </script>
                    </div>
                </div>
            <?php
            }
            ?>
            <hr class="vachOD">
            <div class="TongTienOD">

                <div class="col-1" style="font-size: 1.5vw;"> <b>Tổng tiền: </b></div>
                <div class="col-2"></div>
                <div class="col-3"></div>
                <div class="col-4">
                    <script>
                        <?php
                        $order = getOrderbyID($id);
                        $row2 = $order->fetch_assoc();
                        ?>
                        var totalprice = <?php echo $row2['totalmount'] ?>;
                        document.write(nf.format(totalprice) + "<sup>đ</sup>");
                    </script>
                </div>
            </div>

        </div>
    </div>
</body>

</html>