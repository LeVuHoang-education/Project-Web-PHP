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
        $minPrice = $min;
        $maxPrice = $max;
        $category = 0;
        include "./assets/frontend/pages/productList/productList.php";
      }
      function getProductBySugestion(array $type)
      {
        $GLOBALS['itemID'] = $type;
        include "./assets/frontend/component/suggestion/suggestion.php";
      }
      ?>
      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/phong-cach-cao-cap.png">
        <?php
        getProductByRange(30000000, 99999999, $conn);
        ?>
      </div>
      <hr />
      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/ads_1.png">
        <?php
        $arr = [12, 27, 28, 12, 12];
        getProductBySugestion($arr);
        ?>
      </div>
      <hr />

      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/mau-sac-tuoi-sang-nhe-nhang.png">
        <?php
        $arr = [12, 14, 15, 16, 10];
        getProductBySugestion($arr);
        ?>
      </div>
      <hr />

      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/nang-tam-trai-nghiem.png">
        <?php
        $arr = [3, 27, 28, 29, 30];
        getProductBySugestion($arr);
        ?>
      </div>
      <hr />

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