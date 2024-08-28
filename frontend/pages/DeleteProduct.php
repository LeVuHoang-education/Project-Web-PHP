<?php 
    require('../../db/connect.php');
    if(isset($_GET['proid'])){
        $proid = $_GET['proid'];
        $DeleteProduct_sql = "DELETE FROM product WHERE proid = ?";
        $stmt = $conn->prepare($DeleteProduct_sql);
        if($stmt){
            $stmt->bind_param("i", $proid);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                header("Location: ../../adminpanel/pages/index.php?act=SanPham&catid=0&page=1");
            }else{
                echo "Delete failed";
            }
            $stmt->close();
        }else{
            echo "Delete failed";
        }
    }else{
        echo "Can't find product id";
    }

?>