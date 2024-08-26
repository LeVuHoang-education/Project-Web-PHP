<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "../../frontend/pages/Function.php";
    $getOD = getOrderbyID($_GET['ID']);
    $sql = "SHOW COLUMNS FROM orders LIKE 'status'";
    if ($rows = $conn->query($sql)->fetch_assoc()) {
        $enumValues = str_replace("'", "", substr($rows['Type'], 5, -1));
        $enumArray = explode(",", $enumValues);
    } else {
        die("Không thể lấy các giá trị enum.");
    }
    while ($row = $getOD->fetch_assoc()) {
    ?>
        <form action="../../frontend/pages/Updatestatus.php?orderid=<?php echo $row['orderid']?>" method="post">
            <label for="orderid">Mã đơn hàng</label>
            <input type="text" name="orderid" id="orderid" value="<?php echo $row['orderid']; ?>" disabled>
            <label for="status">Trạng thái</label>

            <select name="status" id="status">
                <?php 
                    foreach($enumArray as $value){
                        if($value == $row['status']){
                            echo "<option value='$value' selected>$value</option>";
                        }else{
                            echo "<option value='$value'>$value</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" value="Cập nhật">
        <?php
    }
        ?>
        </form>
</body>

</html>