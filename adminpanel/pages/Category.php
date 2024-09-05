<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Category.css">
    <title>Document</title>
</head>

<body>
    <div id="addCatForm" class="addCat">
        <span class="close">&times;</span>
        <form action="../../frontend/pages/ThemDanhMuc.php" method="post">
            <div class="combobox-Cat">
                <label for="catname">Tên danh mục: </label>
                <input type="text" name="catname" id="catname" required placeholder="Enter category name">
            </div>
            <button class="modal-btn" type="submit" name="btn-reg" value="addCategory">Add</button>
        </form>
    </div>
    <div class="Category-container">
        <table class="cat-table">
            <tr class="cat-header">
                <th class="catcol-1">Mã danh mục</th>
                <th class="catcol-2">Tên danh mục</th>
                <th class="catcol-3"> <button id="addCat"><img src="../../assets/fontend/img/Icon/add.png" alt=""></img></button></th>
            </tr>

            <?php
            require('../../db/connect.php');

            $GetCategory_sql = "SELECT * FROM category order by catid";

            $ListCategory = $conn->query($GetCategory_sql);

            while ($row =  mysqli_fetch_assoc($ListCategory)) {
                $sql = "SELECT COUNT(DISTINCT P.proid) AS total_pending_products 
                FROM product P 
                JOIN category C ON P.catid = C.catid 
                JOIN `order-detail` OD ON P.proid = OD.proid 
                JOIN orders O ON OD.orderid = O.orderid 
                WHERE O.status != 'Đã giao' 
                AND C.catid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $row['catid']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row1 = $result->fetch_assoc()['total_pending_products'];

                $deleteDisabled = $row1 > 0 ? "disabled" : "";
                $deleteMessage = $row1 > 0 ? "Có sản phẩm đang chờ xử lý" : "Bạn có chắc muốn xóa danh mục này";

            ?>
                <tr>
                    <td class="catcol-1"> <?php echo $row['catid'] ?></td>
                    <td class="catcol-2"> <?php echo $row['catname'] ?></td>
                    <td class="catcol-3 ">
                        <a href="javascript:void(0);"
                            onclick="confirmDelete('<?php echo $deleteMessage; ?>', '<?php echo $deleteDisabled; ?>', <?php echo $row['catid']; ?>);"
                            aria-disabled="<?php echo htmlspecialchars($deleteDisabled); ?>"
                            <?php echo $deleteDisabled ? 'style="pointer-events: none; background-color:gray ;color: white;"' : ''; ?>>
                            Xóa
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <script>
        var modal = document.getElementById("addCatForm");
        var btn = document.getElementById("addCat");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function confirmDelete(message, isDisabled, catid) {
            if (isDisabled !== 'disabled') {
                if (confirm(message)) {
                    window.location.href = `../../frontend/pages/XoaDanhMuc.php?catid=${catid}`;
                }
            }
        }
    </script>
</body>


</html>