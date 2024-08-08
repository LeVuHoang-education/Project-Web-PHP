<?php
    require('../../db/connect.php');
    if(isset($_GET['catid'])) {
        $catid = $_GET['catid'];
        $sql = "DELETE FROM category WHERE catid = ?";
        $stmt = $conn->prepare($sql);
        if($stmt) {
            $stmt->bind_param("i", $catid);
            $stmt->execute();
            if($stmt->affected_rows > 0) {
                header("Location: ../../adminpanel/pages/index.php?act=DanhMuc");
            } else {
                echo "Delete failed";
            }
            $stmt->close();
        } else {
            echo "Delete failed";
        }
    } else {
        echo "Can't find category id";
    }

?>