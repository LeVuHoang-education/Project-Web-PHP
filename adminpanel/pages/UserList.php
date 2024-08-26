<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/UserList.css">
    <title>User manager</title>
</head>

<body>
    <div class=".containner">
        <table id="userList">
            <tr>
                <th>id</th>
                <th>User name</th>
                <th>Phone number</th>
                <th>Email</th>
                <th>Password</th>
                <th>Gender</th>
                <th>Role</th>
                <th></th>
            </tr>
            <?php
            require('../../db/connect.php');
            $GetUser_sql = "SELECT * FROM account order by userid";

            $ListUser = $conn->query($GetUser_sql);


            while ($row = $ListUser->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['userid']; ?></td>
                    <td><?php echo $row['username'];  ?></td>
                    <td><?php echo $row['phonenumber'];  ?></td>
                    <td><?php echo $row['email'];  ?></td>
                    <td><?php echo $row['password'];  ?></td>
                    <td><?php echo $row['gender'];  ?></td>
                    <td><?php echo $row['userrole'];  ?></td>
                    <td>
                        <a href="index.php?act=EditUser&userid=<?php echo $row['userid']?>"> <button type="submit">Edit</button> </a>
                        <a onclick="return confirm('Ban co muon xoa account nay');" href="../../frontend/pages/DeleteUser.php?userid=<?php echo $row['userid'] ?>"> <button type="submit">Delete</button> </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>