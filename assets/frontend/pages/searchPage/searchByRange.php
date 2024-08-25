<?php
if (isset($_POST['min-range']) && isset($_POST['max-range'])) {
    $minValue = $_POST['min-range'];
    $maxValue = $_POST['max-range'];
    if ($minValue >= $maxValue) {
        echo "<scrpit>alert('Khoảng giá mà bạn chọn không hợp lệ');</scrpit>";
    }
}
