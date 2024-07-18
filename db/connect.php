<?php
    $conn = new mysqli('localhost', 'HaoCao', '', 'quanlibanhangnoithat');

    if(!$conn){
        die('Không thể kết nối: '.$conn-> connect_error());
    }

    // if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    //     echo 'We don\'t have mysqli!!!';
    // } else {
    //     echo 'Phew we have it!';
    // }
?>