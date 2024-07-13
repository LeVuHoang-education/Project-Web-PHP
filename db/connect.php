<?php
    $conn = new mysqli('localhost', 'user2', '', 'quanlibanhangnoithat');

    if(!$conn){
        die('Không thể kết nối: '.$conn-> connect_error());
    }
?>