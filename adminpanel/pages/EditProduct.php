<?php
require('../../db/connect.php');

$sql = "SHOW COLUMNS FROM product LIKE 'sales'";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $enumValues = $row['Type'];
    preg_match_all('/\'(.*?)\'/', $enumValues, $matches);
    $enumValues = $matches[1];
} else {
    die("Error executing query: " . $conn->error);
}


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
        <form action="../../frontend/pages/UpdateProduct.php?proid=<?php echo $row['proid']; ?>" method="post" enctype="multipart/form-data">
            <h1><img src="../../assets/fontend/img/Icon/add-product.png" alt=""></h1>
            <div class="combobox">
                <label for="proname">Tên: </label>
                <input type="text" name="proname" id="proname" required placeholder="Enter product name" value="<?php echo $row['proname']; ?> ">
            </div>
            <div class="combobox1">
                <label for="proprice">Giá: </label>
                <input type="text" required name="proprice" id="proprice" value="<?php echo $row['proprice']; ?> ">
                <label for="category">Danh mục: </label>
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

            <div class="combobox1">
                <label for="prostock">Số lượng: </label>
                <input type="number" name="prostock" id="prostock" required placeholder="Enter value of product in stock" value="<?php echo $row['prostock']; ?>">
                <label for="sales">Giảm giá: </label>
                <select name="sales" id="sales">
                    <?php
                    foreach ($enumValues as $value) {
                        if ($value == $row['sales']) {
                            echo '<option value="' . htmlspecialchars($value) . '" selected>' . htmlspecialchars($value) . '</option>';
                        } else {
                            echo '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="combobox">
                <div class="box_trai">

                    <label for="imagepath">Chọn ảnh mới (hoặc để trống để giữ ảnh hiện tại):</label>
                    <input type="file" name="image_path" id="imagepath" value="<?php echo $row['image_path'] ?>">
                </div>
                <div class="box_phai">

                    <?php if (!empty($row['image_path'])): ?>
                        <img src="../../UploadImage/<?php echo htmlspecialchars($row['image_path']); ?>" alt="Current Image" width="100">
                        <p><?php echo htmlspecialchars($row['image_path']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="combobox">
                <label for="is_outstanding">Nổi bật:</label>
                <select name="is_outstanding">
                    <?php 
                        if($row['is_outstanding'] == 1){
                            echo '<option value="1" selected>Có</option>';
                            echo '<option value="0">Không</option>';
                        } else {
                            echo '<option value="1">Có</option>';
                            echo '<option value="0" selected>Không</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="combobox">
                <label for="prodes">Mô tả: </label>
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