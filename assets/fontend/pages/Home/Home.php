<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Home.css" />
  <link rel="stylesheet" href="../Component/Header/Header.css" />
  <title>Home</title>
</head>

<body>
  <?php include "../Component/Header/header.php"; ?>

  <hr />
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
      <div id="category">TABLES</div>
      <div id="show-products">

        <?php
        require('../../../../db/connect.php');
        $sql = "SELECT * FROM product";
        $listProducts = $conn->query($sql);
        while ($row = $listProducts->fetch_assoc()) {
        ?>
          <div class="product">
            <a href="./product.html">

              <img class="thumbnail-product" src=<?php echo "../../src/Product/".$row["image_path"] ?> alt="type" />
              <div class="info">
                <ul>
                  <li><?php echo $row['proname']; ?></li>
                  <li>
                    <?php echo $row['proprice']; ?>
                  </li>
                  <li>Status:
                    <?php if ($row['prostock'] > 0) {
                      echo "Stockiing";
                    } else {
                      echo "Out stock";
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