<?php
    $usernametb = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];


    require '../../db/connect.php';

    $themsql = "INSERT INTO account (username,email ,phonenumber, password, gender) VALUES ('$usernametb','$email','$phonenumber','$password','$gender')";
    //echo $themsql; exit;
    if(mysqli_query($conn, $themsql)){
        echo "<h1>them thanh cong</h1>";
    }
?>