<?php
include 'UploadFile.php';
require('../../db/connect.php');
if (isset($_GET['proid']) && isset($_POST['proname']) && isset($_POST['proprice']) && isset($_POST['catid'])) {
    $proid = $_GET['proid'];
    $proname = $_POST['proname'];
    $proprice = $_POST['proprice'];
    $catid = $_POST['catid'];
    $prostock = $_POST['prostock'];
    $sales = $_POST['sales'];
    $targetDir = "../../UploadImage/";

    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $image_path = Uploads($_FILES['image_path'], $targetDir);
    } else {
        $sql = "SELECT image_path FROM product WHERE proid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $proid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_path = $row['image_path'];
        }
    }

        $prodescription = $_POST['prodescription'];
    

        $UpdateProduct_sql = "UPDATE product SET proname = ?, proprice = ?, catid = ?, prostock = ?, image_path = ?, prodescription = ?, sales = ? WHERE proid = ?";
        $stmt = $conn->prepare($UpdateProduct_sql);

        if ($stmt) {
            $stmt->bind_param("sdiisssi", $proname, $proprice, $catid, $prostock, $image_path, $prodescription,$sales, $proid);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: ../../adminpanel/pages/index.php?act=SanPham&catid=0");
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
?>
