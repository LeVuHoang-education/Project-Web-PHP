<?php
require __DIR__ . '../../../db/connect.php';

//Dem so luong khach hang
$khachdn = "SELECT COUNT(*) as totalRegistered  FROM account";
$resultdn = $conn->query($khachdn);
if ($resultdn->num_rows > 0) {
    $rowDn = $resultdn->fetch_assoc();
    $totalRegistered = $rowDn['totalRegistered'];
} else {
    $totalRegistered = 0;
}

$khachvl = "SELECT COUNT(*) as totalvl FROM guest";
$resultvl = $conn->query($khachvl);
if ($resultvl->num_rows > 0) {
    $rowvl = $resultvl->fetch_assoc();
    $totalGuest = $rowvl['totalvl'];
} else {
    $totalGuest = 0;
}

$totalCustomers = $totalRegistered + $totalGuest;

//Dem so luong san pham
$countPro = "SELECT COUNT(*) as totalPro FROM product";
$resultPro = $conn->query($countPro);
if ($resultPro->num_rows > 0) {
    $rowPro = $resultPro->fetch_assoc();
    $totalPro = $rowPro['totalPro'];
} else {
    $totalPro = 0;
}

//Dem so luong don hang
$countOrder = "SELECT COUNT(*) as totalOrder FROM orders";
$resultOrder = $conn->query($countOrder);
if ($resultOrder->num_rows > 0) {
    $rowOrder = $resultOrder->fetch_assoc();
    $totalOrder = $rowOrder['totalOrder'];
} else {
    $totalOrder = 0;
}

//Tinh tong doanh thu theo thang
$sqlDT = "SELECT SUM(totalmount) AS total_revenue 
        FROM orders 
        WHERE MONTH(orderdate) = MONTH(CURRENT_DATE())
        AND YEAR(orderdate) = YEAR(CURRENT_DATE())";
$result = $conn->query($sqlDT);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalRevenue = $row['total_revenue'];
}

//lay ten vs userid
function getNameU($id)
{
    global $conn;
    $sql = "SELECT * FROM account WHERE userid = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['username'];
    }
}

function getNameG($id)
{
    global $conn;
    $sql = "SELECT * FROM guest WHERE guestid = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['guestname'];
    }
}


//Lay don hang gan nhat
$sqlOD = "SELECT userid , guestid , status , totalmount , payment_status
FROM orders 
ORDER BY orderdate DESC 
LIMIT 10";

$result10OD = $conn->query($sqlOD);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Dashboard.css">
    <title>Document</title>
</head>

<body>
    <div class="dasboard-body">
        <div class="dashboard-overview">
            <div class="overbox">
                <div class="tttext">
                    <p><?php echo $totalCustomers ?></p>
                    <span>Khách hàng</span>
                </div>
                <img src="../../assets/frontend/img/Icon/icons8-eye-96.png" alt="">
            </div>

            <div class="overbox">
                <div class="tttext">
                    <p><?php echo $totalPro ?></p>
                    <span>Sản phẩm</span>
                </div>
                <img src="../../assets/frontend/img/Icon/icons8-product-100.png" alt="">
            </div>

            <div class="overbox">
                <div class="tttext">
                    <p><?php echo $totalOrder ?></p>
                    <span>Đơn hàng</span>
                </div>
                <img src="../../assets/frontend/img/Icon/icons8-order-100.png" alt="">
            </div>

            <div class="overbox">
                <div class="tttext">
                    <p><?php echo number_format($totalRevenue) . ' đ' ?></p>
                    <span>Doanh thu</span>
                </div>
                <img src="../../assets/frontend/img/Icon/icons8-earning-100.png" alt="">
            </div>
        </div>

        <div class="dashboard-recentorder">
            <h2>Đơn hàng gần đây</h2>
            <table>
                <tr>
                    <th>Tên</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                </tr>
                <?php if ($result10OD->num_rows > 0) {
                    while ($row = $result10OD->fetch_assoc()) {
                        if ($row['userid'] != null) {
                            $name = getNameU($row['userid']);
                        } else {
                            $name = getNameG($row['guestid']);
                        }
                ?>
                        <tr class="overview-content">
                            <td><?php echo $name ?></td>
                            <td><?php echo number_format($row['totalmount']) ?></td>
                            <td><?php echo $row['payment_status'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                        </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</body>

</html>