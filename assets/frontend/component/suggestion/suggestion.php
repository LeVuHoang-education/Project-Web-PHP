<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="suggestion-container">
        <div class="suggestion-content">
            <?php 
            include "db/connect.php";
            include "frontend/global/variable.php";
            if (empty($itemID)){
                echo "<script>alert('empty');</script>";
            }
            foreach ($itemID as $item) {
                $ID=$item;
                echo $ID;
                include 'assets/frontend/component/Item/item.php';
            } ?>
        </div>
    </div>
</body>

</html>