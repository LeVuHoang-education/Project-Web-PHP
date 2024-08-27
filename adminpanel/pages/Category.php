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
                <label for="catname">Category name: </label>
                <input type="text" name="catname" id="catname" required placeholder="Enter category name">
            </div>
            <button class="modal-btn" type="submit" name="btn-reg" value="addCategory">Add</button>
        </form>
    </div>
    <div class="Category-container">
        <table class="cat-table">
            <tr class="cat-header">
                <th class="catcol-1">ID</th>
                <th class="catcol-2">Category name</th>
                <th class="catcol-3"> <button id="addCat"><img src="../../assets/fontend/img/Icon/add.png" alt=""></img></button></th>
            </tr>

            <?php
            require('../../db/connect.php');

            $GetCategory_sql = "SELECT * FROM category order by catid";

            $ListCategory = $conn->query($GetCategory_sql);

            while ($row =  mysqli_fetch_assoc($ListCategory)) {
            ?>
                <tr>
                    <td class="catcol-1"> <?php echo $row['catid'] ?></td>
                    <td class="catcol-2"> <?php echo $row['catname'] ?></td>
                    <td class="catcol-3 ">
                        <a onclick="return confirm('Ban co muon xoa category nay');" href="../../frontend/pages/XoaDanhMuc.php?catid=<?php echo $row['catid'] ?>"> <button type="submit">Delete</button> </a>
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
    </script>
</body>


</html>