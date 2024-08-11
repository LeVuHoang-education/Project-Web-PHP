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
                    <option value="0">All</option>
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
                <button type="submit">Search</button>
            </form>
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
                        <a href="../../adminpanel/pages/index.php?act=EditProduct&proid=<?php echo $row['proid'] ?>">Edit</a>
                        <a onclick=" confirm ('Ban co chac muon xoa san pham nay');" href="../../../../fontend/pages/DeleteProduct.php?proid= <?php echo $row['proid'] ?>">Delete</a>
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