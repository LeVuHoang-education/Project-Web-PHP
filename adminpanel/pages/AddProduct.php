<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AddProduct.css">
    <title>Add new product - product manager</title>
</head>

<body>
    <div class="containner-ap">
        <form action="../../../../frontend/pages/ThemSanPham.php" method="post" enctype="multipart/form-data">
            <h1><img src="../../assets/fontend/img/Icon/add-product.png" alt=""></h1>
            <div class="combobox">
                <label for="proname">Tên: </label>
                <input type="text" name="proname" id="proname" required placeholder="Enter product name">
            </div>
            <div class="combobox1">
                <label for="proprice">Giá: </label>
                <input type="text" required name="proprice" id="proprice">
                <label for="category">Danh mục: </label>
                <select name="catid" id="catname">
                    <?php
                    require('../../db/connect.php');
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value= "<?php echo $row['catid'];?>" > <?php echo $row['catname'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <?php
            $sql = "SHOW COLUMNS FROM product LIKE 'sales'";
            $result = $conn->query($sql);
            
            if ($result) {
                $row = $result->fetch_assoc();
                $enumValues = $row['Type'];
                preg_match_all('/\'(.*?)\'/', $enumValues, $matches);
                $enumValues = $matches[1];
            } else {
                die("Error executing query: " . $conn->error);
            }?>
            <div class="combobox1">
                <label for="prostock">Stock: </label>
                <input type="number" name="prostock" id="prostock" required placeholder="Enter value of product in stock">
                <label for="sales">Giảm giá</label>
                <select name="sales" id="sales">
                    <?php
                    foreach ($enumValues as $value) {
                        if ($value == 'Null') {
                            echo '<option value="' . htmlspecialchars($value) . '" selected>' . htmlspecialchars($value) . '</option>';
                        } else {
                            echo '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="combobox">
                <label for="imagepath" id="imagepath">Ảnh: </label>
                <input type="file" name="image_path" id="imagepath">
            </div>

            <div class="combobox">
                <label for="prodes" id="prodes" >Mô tả: </label>
                <textarea name="prodescription" id="prodes" cols="30" rows="5" placeholder="Enter product description"></textarea>
            </div>
            <button type="submit" name="btn-reg" value="addProduct" >Thêm</button>
        </form>
      
    </div>
</body>

</html>