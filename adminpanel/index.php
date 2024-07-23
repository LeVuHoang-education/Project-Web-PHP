<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin pages</title>
    <link rel="stylesheet" type="text/css" href="css/stylesadmin.css">
</head>

<body>

    <?php
    include "./adminHeader.php";
    ?>
    <div class="container">
            <?php
            include "./adminSidebar.php";
            include_once "../db/connect.php";
            ?>
        <div class="main" id="content">
            <h1>Admin Panel</h1>
            <p>Welcome to the admin panel</p>
        </div>
    </div>
</body>
<script type="text/javascript" src="../assets/fontend/js/ajaxWork.js"></script>
<script type="text/javascript" src="../assets/fontend/js/jquery-3.7.1.js"></script>
</html>