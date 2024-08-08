<?php
    include 'UploadFile.php';

    require('../../db/connect.php');
    if(isset($_POST['btn-reg'])){
        $proname = $_POST['proname'];
        $proprice = $_POST['proprice'];
        $catid = $_POST['catid'];
        $prostock = $_POST['prostock'];
        $imagePath = $_FILES['image_path']['name'];
        $Description = $_POST['prodescription'];
        $targetDir = "../../UploadImage/";
        $imagePath = Uploads($_FILES['image_path'], $targetDir);

        $addSql = "INSERT INTO product(proname, proprice, catid, prostock, image_path, prodescription) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($addSql);
        if($stmt){
            $stmt->bind_param("sdiiss", $proname, $proprice, $catid, $prostock, $imagePath, $Description);
            $stmt->execute();

            if($stmt->affected_rows > 0){
                header("Location: ../../adminpanel/pages/index.php?act=SanPham&catid=0");
            }else{
                echo "Add failed";
            }
            $stmt->close();
        }else{
            echo "Add failed";
        }
    }else{
        echo "Can't find product id";
    }
?>