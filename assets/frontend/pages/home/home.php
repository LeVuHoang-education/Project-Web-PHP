<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="../../component/header/header.css" />
  <link rel="stylesheet" href="../../component/Footer/Footer.css" />
  <link rel="stylesheet" href="../../component/ShowProduct/ShowProduct.css" />
  <title>Home</title>
</head>

<body>

  <?php
  include "../../component/header/header.php"; 
  ?>

  <div class="container">
    <!--ads-->
    <div class="ads">
      <a href="#">
        <img class="ads-img" style="float:left;" src="../../src/Home/ads/2.jpg" alt="ads" />
      </a>
    </div>
    <!--main content-->
    <div class="main-container">
      <div class="path">
        <a href="./Home.php">Trang chủ</a>
      </div>
    </div>

    <!--ads-->
    <div class="ads">
      <a href="#">
        <img class="ads-img" src="../../src/Home/ads/2.jpg" alt="ads" />
      </a>
    </div>
  </div>
  <script src="./Home.js"></script>
  <?php include "../../component/footer/footer.php" ?>
</body>

</html>