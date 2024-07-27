<?php
require('../../db/connect.php');
if (isset($_POST['btn-reg'])) {
    $catname = $_POST['catname'];
    $sql = "INSERT INTO category(catname) VALUES (?)";

    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("s", $catname);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            header("Location: ../../adminpanel/pages/index.php?act=DanhMuc");
        }else{
            echo "Add failed";
        }
        $stmt->close();
    } else {
        echo "Add failed";
    } 
    $stmt->close();
} else {
    echo "Can't find category name";
}
?>
