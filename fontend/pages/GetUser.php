<?php
    require ('../../db/connect.php');
    $GetUser_sql = "SELECT * FROM account order by userid";

    $ListUser = $conn->query($GetUser_sql);

    while($row = $ListUser->fetch_assoc()){
        echo $row['userid']." - ".$row['username']." - ".$row['email']." - ".$row['phonenumber']." - ".$row['password']." - ".$row['gender'];
    }
?>
