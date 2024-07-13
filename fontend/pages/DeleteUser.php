<?php
require('../../db/connect.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $DeleteUser_sql = "DELETE FROM account WHERE userid = ?";
    $stmt = $conn->prepare($DeleteUser_sql);

    if ($stmt) {
        $stmt->bind_param("i", $userid);
        $stmt->execute();


        if ($stmt->affected_rows > 0) {
            header("Location: ../../assets/fontend/pages/User/UserList.php");
        } else {
            echo "Delete failed";
        }
        $stmt->close();
    } else {
        echo "Delete failed";
    }
} else {
    echo "Can't find user id";
}
$conn->close();

?>