<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sản phẩm</title>
</head>

<body>
  <div class="container">
    <?php
    if (isset($_GET['act'])) {
      if ($_GET['act'] == 'productList') {
        // if (isset($_GET['feature']) && $_GET['feature'] == 'searching') {
        //   include "./assets/frontend/component/suggestion/suggestion.php";
        // }
        if (isset($_GET['cat'])) {
          include  "./assets/frontend/component/productCard/productCard.php";
        }
      }
    }

    ?>
  </div>
</body>

</html>