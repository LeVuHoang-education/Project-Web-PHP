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
        require './db/connect.php';
      require_once './frontend/pages/Function.php';
      function getProductByRange($min, $max, $conn)
      {
        $minPrice = $min;
        $maxPrice = $max;
        $category = 0;
        include "./assets/frontend/pages/productList/productList.php";
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
        $arr = [30, 27, 28, 44, 12];
        getProductBySugestion(4);
        ?>
      </div>
      <hr />

      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/mau-sac-tuoi-sang-nhe-nhang.png">
        <?php
        // $arr = [12, 14, 15, 16, 10];
        getProductBySugestion(2);
        ?>
      </div>
      <hr />

      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/nang-tam-trai-nghiem.png">
        <?php
        // $arr = [3, 27, 28, 29, 30];
        getProductBySugestion(3);
        ?>
      </div>
      <hr />

      <div class="content">
        <img id="ads" src="assets/frontend/src/Home/ads/tiec-tra-thuong-hang-huong-thom-quy-phai.png">
        <?php
        // getProductByRange(0, 4999999, $conn);
        $arr = [31, 32, 33, 43];
        getProductBySugestion(4);
        ?>
      </div>
    </div>
  </div>
</body>

</html>