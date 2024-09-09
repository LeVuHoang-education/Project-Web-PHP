<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Orders.css">
    <title>Order</title>
</head>

<body>
    <form action="index.php?act=DonHang" method="post" class="form-search">
        <input type="text" name="oid" placeholder="Tìm đơn hàng...">
        <select name="status">
            <?php
            require_once('../../db/connect.php');
            $sql = "SHOW COLUMNS FROM orders LIKE 'status'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $enumValues = $row['Type'];
                preg_match_all('/\'(.*?)\'/', $enumValues, $matches);
                $enumValues = $matches[1];
            } else {
                die("Error executing query: " . $conn->error);
            }
            foreach ($enumValues as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
        </select>
        <input type="submit" value="Tìm kiếm" name="search">
    </form>

    <table class="order-Table">
        <tr class="order-Head-Table">
            <th>Mã đơn hàng</th>
            <th>Mã người dùng </th>
            <th>Thời gian</th>
            <th>Thành tiền</th>
            <th>Trạng thái</th>
            <th></th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            if (!empty($_POST['oid'])) {
                $oid = $_POST['oid'];
                $GetOrder_sql = "SELECT * FROM orders WHERE orderid = ? order by orderid";
                $stmt = $conn->prepare($GetOrder_sql);
                $stmt->bind_param("i", $oid);
                $stmt->execute();
                $result = $stmt->get_result();
            } else if (!empty($_POST['status'])) {
                $statussql = $_POST['status'];
                $GetOrder_sql = "SELECT * FROM orders WHERE status = ? order by orderid";
                $stmt = $conn->prepare($GetOrder_sql);
                $stmt->bind_param("s", $statussql);
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $GetOrder_sql = "SELECT * FROM orders order by orderid";
                $result = $conn->query($GetOrder_sql);
            }
        }
        else {
            $GetOrder_sql = "SELECT * FROM orders order by orderid";
            $result = $conn->query($GetOrder_sql);
        }
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr class="Order-content">
                <td><?php echo $row['orderid'] ?></td>
                <td><?php
                    if ($row['userid'] == 0) {
                        echo 'Khách: ' . $row['guestid'];
                    } else {
                        echo  'Người dùng:' . $row['ugtserid'];
                    }
                    ?></td>
                <td><?php echo $row['orderdate'] ?></td>
                <td><?php echo number_format($row['totalmount'], 0, ',', ',')  ?> đ</td>
                <td><?php echo $row['status'] ?></td>
                <td class="Chucnang_od"><a href="index.php?act=ODetail&ID=<?php echo $row['orderid'] ?>">Chi tiết</a>
                    <a href="index.php?act=UpdateOD&ID=<?php echo $row['orderid'] ?>">Cập nhật trạng thái</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>