<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href=" ../../component/productCard/productCard.css" />
  <link rel="stylesheet" href="../../component/header/header.css" />
  <link rel="stylesheet" href="../../component/Footer/Footer.css" />
  <!-- <script src="../../component/header/header.js"></script> -->
  <title>Trang chủ</title>
</head>

<body>
  <?php
  include "../../component/header/header.php";
  ?>

  <div class="container">
    <!--ads-->
    <div class="ads">
      <a href="#">
        <img class="ads-img" style="float:left;" src="../../src/Home/ads/2015.png" alt="ads" />
      </a>
    </div>
    <!--main content-->
    <div class="main-container">
      <?php
      require('../../../../db/connect.php');
      function renderProductCard()
      {
        include "../../component/productCard/productCard.php";
      }
      function categoryID()
      {
        global $category;
        return $category;
      }

      $minPrice = 0;
      $maxPrice = 0;

      function getMinPrice()
      {
        global $minPrice;
        return $minPrice;
      }
      function getMaxPrice()
      {
        global $maxPrice;
        return $maxPrice;
      }
      function getProductByRange($min, $max, $conn)
      {
        global $category;
        $category = 0;
        global $minPrice;
        $minPrice = $min;
        global $maxPrice;
        $maxPrice = $max;
        renderProductCard();
      }

      ?>

      <div class="content">
        <h1>Sản phẩm trên 10 triệu</h1>
        <?php
        getProductByRange(10000000, 99999999, $conn);
        ?>
      </div>
      <div class="content">
        <h1>Sản phẩm trên 5 triệu</h1>
        <?php
        getProductByRange(5000000, 9999999, $conn);
        ?>
      </div>
      <div class="content">
        <h1>Sản phẩm dưới 5 triệu</h1>
        <?php
        getProductByRange(0, 4999999, $conn); 
        ?>
    </div>
  </div>
  <!--ads-->
  <div class="ads">
    <a href="#">
      <img class="ads-img" src="../../src/Home/ads/2015.png" alt="ads" />
    </a>
  </div>
  <script src="./Home.js"></script>
</div>  
<?php include "../../component/footer/footer.php" ?>

</body>

</html>