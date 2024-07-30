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
                header("Location: ../../assets/fontend/pages/Product/ProductList.php");
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