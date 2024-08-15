<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
</head>

<body>

  <div class="container">
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
      function getProductBySugestion(array $type)
      {
        include "./frontend/global/variable.php";
        $GLOBALS['itemID'] = $type;
        include "./assets/frontend/component/suggestion/suggestion.php";
      }
      ?>


      <div class="content">
        <h1>Các bộ nội thất cao cấp</h1>
        <?php
        getProductByRange(10000000, 99999999, $conn);
        ?>
      </div>
      <div class="content">
        <h1>Siêu ưu đãi cùng Nhật Hoàng</h1>
        <img id="ads" src="assets/frontend/src/Home/ads/ads_1.png">
        <?php
        $arr = [12,27,28,12,12];
        getProductBySugestion($arr);
        ?>
      </div>
      <div class="content">
        <h1>Những bộ nội thất tầm trung</h1>
        <?php
        getProductByRange(5000000, 9999999, $conn);
        ?>
      </div>
      <div class="content">
        <h1>Dòng sản phẩm phổ biến</h1>
        <?php
        getProductByRange(0, 4999999, $conn);
        ?>
      </div>
    </div>
  </div>
</body>

</html>