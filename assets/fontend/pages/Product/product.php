<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Component/Header/Header.css" />
  <link rel="stylesheet" href="../Component/Footer/Footer.css" />
  <link rel="stylesheet" href="../Component/ShowProduct/ShowProduct.css" />
  <link rel="stylesheet" href="./product.css" />
  <title>Product</title>
</head>

<body>
  <?php
  include '../Component/Header/Header.php';
  ?>
  <div class="container">

    <?php
    if (isset($_POST['cat_choose'])) {
      $cat_number = $_POST['cat_choose'];
    } else {
      // Xử lý trường hợp không có giá trị, ví dụ:
      $cat_number = 0; // hoặc một giá trị mặc định khác
    }
    include "../Component/ShowProduct/showProduct.php";
    ?>
  </div>
  <?php include "../Component/Footer/Footer.php" ?>
</body>

</html>