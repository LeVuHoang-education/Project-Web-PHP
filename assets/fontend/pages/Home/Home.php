<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Home.css" />
  <title>Home</title>
</head>

<body>
  <div class="banner-brand">
    <div class="title">NHẬT HOÀNG - NỘI THẤT GIA ĐÌNH PHONG CÁCH HIỆN ĐẠI SỐ 10 VIỆT NAM</div>
    <div class="individual">
      <div class="love-list">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
          </svg>
        </a>
      </div>
      <div class="backet">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
          </svg>
        </a>
      </div>
      <div class="account">
        <a href="#">Đăng nhập/Đăng kí</a></div>
    </div>
  </div>
  <hr />

  <div class="header">
    <div class="intro-brand">
      <div class="logo">
        <img class="thumbnail-brand" src="../../src/Home/LogoFA.png" alt="Logo" />
      </div>
      <div class="title-brand">
        <h2><a href="#">NỘI THẤT NHẬT HOÀNG</a></h2>
      </div>
      <div class="image-brands">
        <img id="image-brand" src="../../src/Home/LogoFA.png" alt="Image" />
        <img id="image-brand" src="../../src/Home/LogoFA.png" alt="Image" /><br />
        <img id="image-brand" src="../../src/Home/SnoopyGaming.jpg" alt="Image" />
        <img id="image-brand" src="../../src/Home/space-themed-gaming-logo-template-3274.png" alt="Image" />
      </div>
    </div>
  </div>
  <div class="taskbar">
    <div class="navbar">
      <ul>
        <li>
          <a href="./Home.php">Home</a>
        </li>
        <li>
          <a href="#">List</a>
        </li>
        <li>
          <a href="#">Promotion</a>
        </li>
        <li>
          <a href="#">Services</a>
        </li>
        <li>
          <a href="#">Support</a>
        </li>
        <li></li>
        <li>
          <a href="#">About Us</a>
        </li>
        <li>
          <a href="#">Account</a>
        </li>
      </ul>
    </div>
  </div>

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
        <a href="./Home.php">Home</a>
      </div>
      <!--Table category-->
      <?php
      require('../../../../db/connect.php');
      $sql = "SELECT * FROM product WHERE catid = 04";
      $listProducts = $conn->query($sql);

      ?>
      <div id="category">TABLES</div>
      <div id="show-products">

        <?php
        while ($row = $listProducts->fetch_assoc()) {
        ?>
          <div class="product">
            <a href="./product.html">
              <img class="thumbnail-product" src="../../src/Home/SnoopyGaming.jpg" alt="type" />
              <div class="info">
                <ul>
                  <li><?php echo $row['proname']; ?></li>
                  <li><?php echo $row['prodescription']; ?></li>
                  <li>Type:
                    <?php if ($row['catid'] == 4) {
                      echo "Table";
                    } else if ($row['catid'] == 3) {
                      echo "Chair";
                    }; ?>
                  </li>
                  <li>
                    <?php echo $row['proprice']; ?>
                  </li>
                  <li>Status:
                    <?php if ($row['prostock'] > 0) {
                      echo "Okay";
                    } else {
                      echo "Sold out";
                    }; ?>
                  </li>
                </ul>
            </a>
          </div>
      </div>
    <?php
        }
    ?>
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

</body>

</html>