<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        var nf = new Intl.NumberFormat();
    </script>
    <script src="./assets/frontend/component/Item/item.js"></script>
</head>

<body>
    <?php
    include "db/connect.php";
    if (isset($_SESSION['proid'])) {
        $ID = $_SESSION['proid'];
        $sql = "SELECT * FROM product WHERE proid = $ID";
        $info = $conn->query($sql);
        $row = $info->fetch_assoc();
    }
    ?>
    <div class="product">
        <a href="../../../../index.php?act=productInfo&prodID=<?php echo $row['proid'] ?>">
            <div class="show-thumbnail">
                <img class="thumbnail-product" src="../../../UploadImage/<?php echo htmlspecialchars($row['image_path']); ?>" alt="type" />
            </div>
            <div class="info">
                <ul>
                    <li class="pro-name"><?php echo $row['proname']; ?></li>
                    <li id="pro_price">
                        <?php if ($row['sales'] == null) { ?>
                            Giá: <script>
                                var price = <?php echo $row['proprice'] ?>;
                                document.write(nf.format(price));
                            </script>đ
                        <?php } else { ?>
                            <div class="old-price" style="color:gray; text-decoration:line-through;font-size:14px;">
                                Giá cũ: <script>
                                    var price = <?php echo $row['proprice'] ?>;
                                    document.write(nf.format(price));
                                </script>đ
                            </div>
                            <div class="new-price" style="color:red;font-size:20px;">
                                Giá mới: <script>
                                    var price = <?php echo $row['proprice'] * (1 - $row['sales'] / 100) ?>;

                                    document.write(nf.format(price));
                                </script>đ
                            </div>
                        <?php
                        } ?>
                    </li>
                </ul>
            </div>
        </a>

        <div class="love-product">
            <button class="add-product" id="add-new-<?= $row['proid']; ?>" name="addcart" type="submit" value="<?= $row['proid']; ?>" onclick="addNew(<?= $row['proid']; ?>)">
                <!-- kiem tra xem lieu sp nay da duoc them vao danh sach yeu thich hay chua -->
                <svg id="love-btn-<?php echo $row['proid']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
            </button>
        </div>
    </div>
    <?php
    if (isset($_SESSION['lovelist'])) {
        $lovelist = $_SESSION['lovelist'];
        if (in_array($ID, $_SESSION['lovelist'])) {
    ?>
            <script>
                var svg = document.getElementById("love-btn-" + <?= $row['proid'] ?>);
                svg.style.fill = "red";
            </script>
    <?php
        }
    }
    ?>
</body>

</html>