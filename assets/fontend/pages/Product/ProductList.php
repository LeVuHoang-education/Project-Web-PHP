<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/ProductList.css">
    <title>Product manager</title>
</head>

<body>

    <div class="container">
        <h2>
            <a href="../../../../adminpanel/index.php"> <img src="../../img/Icon/house-solid.svg" alt=""></a>
            Product manager
            <a href="../../pages/Form/AddProduct.php"> <img src="../../img/Icon/plus.png" alt="" /></a>
        </h2>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Name</div>
                <div class="col col-2">Price</div>
                <div class="col col-3">Category</div>
                <div class="col col-4">Stock</div>
                <div class="col col-5">Image path</div>
                <div class="col col-6"></div>
            </li>
            <?php
            require('../../../../db/connect.php');
            $sql = "SELECT * FROM product order by catid";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <li class="table-row">
                    <div class="col col-1" "> <?php echo $row['proname'] ?></div>
                    <div class=" col col-2"> <?php echo $row['proprice'] ?></div>
                    <div class="col col-3"><?php
                                            $sql1 = "SELECT * from category where catid = " . $row['catid'];
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            echo $row1['catname'] ;
                                            $fileName = pathinfo($row ['image_path'], PATHINFO_BASENAME);
                                            ?>
                                            
                    </div>
                    <div class="col col-4"><?php echo $row['prostock'] ?></div>
                    <div class="col col-5"><?php echo $fileName ?></div>
                    <div class="col col-6">
                        <a href="../../../../fontend/pages/EditProduct.php?proid=<?php echo $row['proid'] ?>">Edit</a>
                        <a onclick=" confirm ('Ban co chac muon xoa san pham nay');" href = "../../../../fontend/pages/DeleteProduct.php?proid= <?php echo $row['proid'] ?>">Delete</a>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</body>

</html>