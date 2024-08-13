<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/pages/shopping/shopping.css">
    <title>Giỏ hàng</title>
</head>

<body>
    <div class="container-shopping">
        <div class="form-group">
            <?php include __DIR__ . "\Aside\Aside.php"; ?>
            <?php
            echo "<div class='shopping-content'>";
            if (isset($_GET['act'])) {
                if ($_GET['act'] == 'shopping') {
                    include __DIR__ . "\\cartList\\cartList.php";
                }
            }
            echo "</div>";
            ?>
        </div>
    </div>
</body>

</html>