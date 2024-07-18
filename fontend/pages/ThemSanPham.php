<?php
    require('../../db/connect.php');
    if(isset($_POST['btn-reg'])){
        $proname = $_POST['proname'];
        $proprice = $_POST['proprice'];
        $catid = $_POST['catid'];
        $prostock = $_POST['prostock'];
        $imagePath = $_FILES['image_path']['name'];
        $Description = $_POST['prodescription'];
        

        
        echo "Name: $proname <br> Price: $proprice <br> Category: $catid <br> Stock: $prostock <br> Image path: $imagePath <br> Description: $Description";
        $addSql = "INSERT INTO product(proname, proprice, catid, prostock, image_path, prodescription) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($addSql);
        if($stmt){
            $stmt->bind_param("sdiiss", $proname, $proprice, $catid, $prostock, $imagePath, $Description);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                move_uploaded_file($_FILES['image_path']['tmp_name'], "../../UploadImage".$_FILES['image_path']['name']);
                header("Location: ../../assets/fontend/pages/Product/ProductList.php");
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