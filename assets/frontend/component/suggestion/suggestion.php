<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/frontend/component/suggestion/sugesstion.css">
</head>

<body>
    <div class="suggestion-container">
        <div class="suggestion-content">
            <?php
            include "db/connect.php";
            foreach ($GLOBALS['itemID'] as $item) {
                $ID = $item;
                include 'assets/frontend/component/Item/item.php';
            } ?>
        </div>
    </div>
</body>

</html>