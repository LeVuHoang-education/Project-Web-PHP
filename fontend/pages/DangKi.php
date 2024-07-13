<?php
    require ('../../db/connect.php');

    if(isset($_POST['btn-reg'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        
        $sql = "INSERT INTO account (username, email, phonenumber, password,gender) VALUES ('$username', '$email', '$phonenumber', '$password', '$gender')";
      //  echo $sql; exit();
        echo "<br>";
        if($conn->query($sql) === TRUE){
            echo "Đăng kí thành công";
        }else{
            echo "Error: ".$sql."<br>".$conn->error;
        }
    }
?>  