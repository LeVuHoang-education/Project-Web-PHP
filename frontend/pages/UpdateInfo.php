 <?php
    require('../../db/connect.php');
    include_once('./Function.php');
    session_start();
    if (isset($_SESSION['user_id'])) {
        if (isset($_POST['username'])) {
            if (isset($_POST['email'])) {
                if (isset($_POST['phonenumber'])) {
                    if (isset($_POST['gender'])) {
                        if (isset($_POST['birthday'])) {
                            $email = $_POST['email'];
                            $phonenumber = $_POST['phonenumber'];
                            $gender = $_POST['gender'];
                            $birthday = $_POST['birthday'];
                            $username = $_POST['username'];

                            $UpdateUser_sql = "UPDATE `account` SET email = ?, phonenumber = ?, gender = ? WHERE userid = ?";
                            $stmt = $conn->prepare($UpdateUser_sql);
                            $stmt->bind_param("ssss", $email, $phonenumber, $gender, $_SESSION["user_id"]);
                            $stmt->execute();

                            $check = getTTKH($_SESSION['user_id']);
                            $data = $check->fetch_assoc();

                            if ($data != null) {
                                $updateTTKH_sql = "UPDATE `ttkh` SET fullname =?, birthday =? WHERE userid =?";
                                $stmt = $conn->prepare($updateTTKH_sql);
                                $stmt->bind_param("sss", $username, $birthday, $_SESSION["user_id"]);
                                $stmt->execute();

                                $stmt->close();
                                $conn->close();
                                header('Location:../../../../index.php?act=account&feature=brief');
                                exit();
                            } else {
                                $insertTTKH_sql = "INSERT INTO `ttkh` (userid, fullname, birthday) VALUES (?,?,?)";
                                $stmt = $conn->prepare($insertTTKH_sql);
                                $stmt->bind_param("sss", $_SESSION['user_id'], $username, $birthday);
                                $stmt->execute();

                                $stmt->close();
                                $conn->close();
                                header('Location:../../../../index.php?act=account&feature=brief');
                                exit();
                            }
                        } else echo "Can not find the user birthday";
                    } else echo "Can not find the user gender";
                } else echo "Can not find the user phone number";
            } else echo "Can not find the user email";
        } else echo "Can not find the user name";
    } else echo "Can not find the user id";
