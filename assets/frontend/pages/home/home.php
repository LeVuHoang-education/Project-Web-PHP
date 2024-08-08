<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
</head>

<body>

  <div class="container">
    <!--ads-->
    <div class="ads">
      <a href='#'><img class='ads-img' src='./assets/frontend/src/Home/ads/2015.png' alt='ads' /></a>
    </div>
    <!--main content-->
    <div class="main-container">
      <?php
      require('./db/connect.php');
      function getProductByRange($min, $max, $conn)
      {
        include "./frontend/global/variable.php";
        $minPrice = $min;
        $maxPrice = $max;
        $category = 0;
        include "./assets/frontend/pages/productList/productList.php";
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
        <img class="ads-img" src="./assets/frontend/src/Home/ads/2015.png" alt="ads" />
      </a>
    </div>
  </div>
</body>

</html>