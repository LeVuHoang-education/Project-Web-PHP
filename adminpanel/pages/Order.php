<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Orders.css">
    <title>Order</title>
</head>

<body>
    <table class="order-Table">
        <tr class="order-Head-Table">
            <th>Mã đơn hàng</th>
            <th>Mã người dùng </th>
            <th>Thời gian</th>
            <th>Thành tiền</th>
            <th>Trạng thái</th>
        </tr>
        <?php
        require('../../db/connect.php');
        $GetOrder_sql = "SELECT * FROM orders order by orderid";
        $result = $conn->query($GetOrder_sql);
        // if ($result === false) {
        //     die('Error in SQL query: ' . $conn->error);
        // }
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr class="Order-content">
                <td><?php echo $row['orderid'] ?></td>
                <td><?php echo $row['userid'] ?></td>
                <td><?php echo $row['orderdate'] ?></td>
                <td><?php echo $row['totalmount'] ?> $</td>
                <td><?php echo $row['status'] ?></td>
            </tr>

        <?php
        } ?>
    </table>
</body>

</html>