<?php
require("../../db/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['is_active'])) {
        $proid = $_POST['proid'];
        $isactive = $_POST['is_active'];
        if ($isactive == "Kích hoạt") {
            $sql = "UPDATE product SET is_active = 1 WHERE proid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $proid);
            if ($stmt->execute()) {
                $stock = "SELECT prostock FROM product WHERE proid = $proid";
                $result = mysqli_query($conn, $stock);
                $row = mysqli_fetch_assoc($result);
                $stock = $row['prostock'];
                if ($stock == 0) {
                    $sql = "UPDATE product SET prostock = 1 WHERE proid = $proid";
                    if (mysqli_query($conn, $sql)) {
                        header("Location: index.php?act=SanPham&catid=0&page=1");
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    header("Location: index.php?act=SanPham&catid=0&page=1");
                }
                header("Location: index.php?act=SanPham&catid=0&page=1");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $sql = "UPDATE product SET is_active = 0 WHERE proid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $proid);
            if ($stmt->execute()) {
                header("Location: index.php?act=SanPham&catid=0&page=1");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ProductList.css">
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <title>Product manager</title>
</head>

<body>
    <?php
    $act = isset($_GET['act']) ? $_GET['act'] : 'SanPham';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;
    ?>
    <div class="container">
        <h2>
            <a href="index.php?act=ThemSanPham"> <img src="../../assets/frontend/img/Icon/add-product.png" alt="" /></a>
            <form action="index.php" method="get">
                <input type="hidden" name="act" value="<?php echo htmlspecialchars($act); ?>">
                <input type="hidden" name="page" value="<?php echo htmlspecialchars($page); ?>">
                <select name="catid" id="catname">
                    <option value="0">Tất cả</option>
                    <?php
                    require("../../db/connect.php");
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?php echo $row['catid']; ?>"><?php echo $row['catname'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <button type="submit">Tìm kiếm</button>
            </form>
        </h2>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Tên</div>
                <div class="col col-2">Giá</div>
                <div class="col col-3">Danh mục</div>
                <div class="col col-4">Số lượng</div>
                <div class="col col-5">Ảnh</div>
                <div class="col col-6"></div>
            </li>
            <?php
            require("../../db/connect.php");
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $limit = 10;
            $from = ($page - 1) * $limit;

            if (isset($_GET['catid'])) {
                $catid = intval($_GET['catid']);
                if ($catid == 0) {
                    $sql = "SELECT * FROM product LIMIT $from, $limit";
                    $result = mysqli_query($conn, $sql);

                    $sqlCount = "SELECT COUNT(*) as total FROM product";
                    $resultCount = mysqli_query($conn, $sqlCount);

                    if ($resultCount) {
                        $rowCount = mysqli_fetch_assoc($resultCount);
                        $count = $rowCount['total'];
                    } else {
                        echo "Error: " . mysqli_error($conn);
                        $count = 0;
                    }
                } else {
                    $sql = "SELECT * FROM product WHERE catid = ? LIMIT $from, $limit";
                    $stmt  = $conn->prepare($sql);
                    $stmt->bind_param("i", $catid);
                    $stmt->execute();

                    $result = $stmt->get_result();

                    $sqlCount = "SELECT COUNT(*) as total FROM product WHERE catid = $catid";
                    $resultCount = mysqli_query($conn, $sqlCount);

                    if ($resultCount) {
                        $rowCount = mysqli_fetch_assoc($resultCount);
                        $count = $rowCount['total'];
                    } else {
                        echo "Error: " . mysqli_error($conn);
                        $count = 0;
                    }
                }
            }
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <li class="table-row">
                    <div class=" col-1" "> <?php echo $row['proname'] ?></div>
                    <div class=" col-2">
                        <script>
                            var price = <?php echo $row['proprice'] ?>;
                            document.write(nf.format(price));
                        </script>
                    </div>
                    <div class=" col-3"><?php
                                        $sql1 = "SELECT * from category where catid = " . $row['catid'];
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row1 = mysqli_fetch_assoc($result1);
                                        echo $row1['catname'];
                                        $fileName = pathinfo($row['image_path'], PATHINFO_BASENAME);
                                        ?>

                    </div>
                    <div class=" col-4"><?php echo $row['prostock'] ?></div>
                    <div class=" col-5"><?php echo $fileName ?></div>
                    <div class=" col-6">
                        <?php
                        if ($row['is_active'] == 1) {
                            $value = "Vô hiệu hóa";
                        } else {
                            $value = "Kích hoạt";
                        }
                        ?>
                        <form action="index.php?act=SanPham&catid=0&page=1" method="post">
                            <input type="hidden" name="proid" value="<?php echo $row['proid'] ?>">
                            <input type="submit" value="<?php echo $value ?>" class="is_active" name="is_active">
                        </form>
                        <a href="../../adminpanel/pages/index.php?act=EditProduct&proid=<?php echo $row['proid'] ?>">chỉnh sửa</a>
                        <a onclick=" confirm ('Ban co chac muon xoa san pham nay');" aria-disabled="true" href="#">Xóa</a>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>

        <div class="pageButton">
            <?php
            $totalPages = ceil($count / 10);
            $selectedPage = 1;
            while ($selectedPage <= $totalPages) {
            ?>
                <a href="../../adminpanel/pages/index.php?act=<?php echo $act ?>&catid=<?php echo $catid ?>&page=<?php echo $selectedPage; ?>">
                    <?php echo $selectedPage; ?>
                </a>
            <?php
                $selectedPage++;
            }
            ?>
        </div>
    </div>
    <script>
        document.getElementById('catname').addEventListener('change', function() {
            var catid = this.value;
        });
    </script>

</body>

</html>