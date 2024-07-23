<?php
    require('../../db/connect.php');

    if (isset($_GET['proid'])) {
        $proid = $_GET['proid'];

        $getProduct_sql = "SELECT * FROM product where proid = ?";
        $stmt = $conn->prepare($getProduct_sql);

        if ($stmt) {
            $stmt->bind_param("i", $proid);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Không tìm thấy sản phẩm.";
            }

            $stmt->close();
        } else {
            echo "Lỗi chuẩn bị câu lệnh.";
        }
        $conn->close();
    } else {
        echo "Không có proid.";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/EditProduct.css">
    <title>Product <?php echo $row['proid']; ?></title>
</head>

<body>
    <div class="containner">
        <form action="/fontend/pages/UpdateProduct.php?proid=<?php echo $row['proid']; ?>" method="post" enctype="multipart/form-data">
            <h1><img src="../../assets/fontend/img/Icon/add-product.png" alt=""></h1>
            <div class="combobox">
                <label for="proname">Name: </label>
                <input type="text" name="proname" id="proname" required placeholder="Enter product name" value="<?php echo $row['proname']; ?> ">
            </div>
            <div class="combobox1">
                <label for="proprice">Price: </label>
                <input type="text" pattern="\d+(\.\d{2})" title="Vui lòng nhập số có dấu thập phân và tối đa hai chữ số sau dấu thập phân" required name="proprice" id="proprice" value="<?php echo $row['proprice']; ?> ">
                <label for="category">Category: </label>
                <select name="catid" id="catname">
                    <?php
                    require('../../db/connect.php');
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?php echo $rows['catid']; ?>"> <?php echo $rows['catname'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="combobox">
                <label for="prostock">Stock: </label>
                <input type="number" name="prostock" id="prostock" required placeholder="Enter value of product in stock" value="<?php echo $row['prostock']; ?>">
            </div>

            <div class="combobox">
                <label for="imagepath">Image path: </label>
                <input type="file" name="image_path" id="imagepath" value="<?php echo $row['image_path'] ?>">
            </div>

            <div class="combobox">
                <label for="prodes">Description: </label>
                <textarea name="prodescription" id="prodes" cols="30" rows="5" placeholder="Enter product description"></textarea>
            </div>
            <button type="submit" name="btn-reg" value="addProduct">save</button>
        </form>

    </div>
</body>
<script>
    document.getElementById("prodes").value = "<?php echo $row['prodescription'] ?>";
</script>

</html>