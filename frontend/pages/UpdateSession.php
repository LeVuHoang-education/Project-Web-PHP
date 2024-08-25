<?php

session_start();
if (isset($_POST['itemId']) && isset($_POST['quantity'])) {
    $itemId = $_POST['itemId'];
    $quantity = intval($_POST['quantity']);

    // Cập nhật số lượng trong session
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item[0] == $itemId) {
            $_SESSION['cart'][$key][2] = $quantity; 
            break; 
        }
    }

    echo "<script>
    alert('Cập nhật số lượng thành công');
</script>";
}
