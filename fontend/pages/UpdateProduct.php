<?php
include 'UploadFile.php';
require('../../db/connect.php');
if (
    isset($_GET['proid']) && isset($_POST['proname']) && isset($_POST['proprice']) && isset($_POST['catid'])
) {
    $proid = $_GET['proid'];
    $proname = $_POST['proname'];
    $proprice = $_POST['proprice'];
    $catid = $_POST['catid'];
    $prostock = $_POST['prostock'];
    $targetDir = "../../UploadImage/";
    $image_path = Uploads($_FILES['image_path'], $targetDir);
    $prodescription = $_POST['prodescription'];

    echo "proid: $proid<br>";
    echo "proname: $proname<br>";
    echo "proprice: $proprice<br>";
    echo "catid: $catid<br>";
    echo "prostock: $prostock<br>";
    echo "prodescription: $prodescription<br>";

    $UpdateProduct_sql = "UPDATE product SET proname = ?, proprice = ?, catid = ?, prostock = ?, image_path = ?, prodescription = ? WHERE proid = ?";
    $stmt = $conn->prepare($UpdateProduct_sql);

    if ($stmt) {
        $stmt->bind_param("sdiissi", $proname, $proprice, $catid, $prostock, $image_path, $prodescription, $proid);
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

?>
