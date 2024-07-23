<?php
require('../../db/connect.php');
if (
    isset($_GET['proid']) && isset($_GET['proname']) && isset($_GET['proprice']) && isset($_GET['catid']) && isset($_GET['prostock'])
    && isset($_GET['image_path']) && isset($_GET['prodescription'])
) {
    $proid = $_GET['proid'];
    $proname = $_GET['proname'];
    $proprice = $_GET['proprice'];
    $catid = $_GET['catid'];
    $prostock = $_GET['prostock'];
    $image_path = $_GET['image_path'];
    $prodescription = $_GET['prodescription'];


    $UpdateProduct_sql = "UPDATE product SET proname = ?, proprice = ?, catid = ?, prostock = ?, image_path = ?, prodescription = ? WHERE proid = ?";
    $stmt = $conn->prepare($UpdateProduct_sql);

    if ($stmt) {
        $stmt->bind_param("sdiiss ", $proname, $proprice, $catid, $prostock, $image_path, $prodescription);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../../assets/fontend/pages/Product/ProductList.php");
            exit();
        } else {
            echo "Cập nhật không thành công hoặc không có thay đổi.";
        }

        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh.";
    }

    $conn->close();
} else {
    echo "Dữ liệu không đầy đủ.";
}
