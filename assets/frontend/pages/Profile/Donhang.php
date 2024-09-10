<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/order.css">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
</head>

<body>
    <div class="order-container">
        <div class="order-content">
            <table id="table-field">
                <tr>
                    <th>ID đơn hàng</th>
                    <th>Ngày lập đơn</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng thanh toán</th>
                    <th>Tình trạng đơn hàng</th>
                    <th></th>
                </tr>

                <?php
                $id = $_SESSION['user_id'];
                $sql = "SELECT * FROM orders WHERE userid = $id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>

                        <td><?php echo $row['orderid'] ?></td>
                        <td><?php echo $row['orderdate'] ?></td>
                        <td>
                            <script>
                                var cost = <?= $row['totalmount'] ?>;
                                document.write(nf.format(cost));
                            </script>
                        </td>
                        <td>
                            <?php echo $row['payment_status'] ?>`
                        </td>
                        <td><?php echo $row['status'] ?></td>
                        <td><a href="../../../../index.php?act=account&feature=orderDetail&id=<?= $row['orderid'] ?>">Chi tiết</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>