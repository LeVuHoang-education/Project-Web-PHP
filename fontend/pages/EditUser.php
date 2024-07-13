<?php
    require('../../db/connect.php');

    // Kiểm tra xem 'userid' có được truyền qua GET hay không
    if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];

        // Câu lệnh chuẩn bị
        $GetUser_sql = "SELECT * FROM account WHERE userid = ?";
        $stmt = $conn->prepare($GetUser_sql);

        if ($stmt) {
            // Liên kết tham số
            $stmt->bind_param("i", $userid); // "i" biểu thị kiểu dữ liệu số nguyên
            $stmt->execute();

            // Lấy kết quả
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Xử lý dữ liệu người dùng từ $row
                // Ví dụ: echo "Username: " . $row['username'];
            } else {
                echo "Không tìm thấy người dùng.";
            }

            $stmt->close();
        } else {
            echo "Lỗi chuẩn bị câu lệnh.";
        }

        $conn->close();
    } else {
        echo "Không có userid.";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/EditUser.css">


    <title>Edit user</title>
</head>

<body style="align-items: center;">
    <div class="main">
        <div class="containner">

            <h1>User: <?php echo $row['username']?>   </h1>
            <hr>
            <form action="../pages/UpdateUser.php?userid=<?php echo $row['userid'] ?>" method="post">
                <label for="username">User name</label><br>
                <input type="text" name="username" id="username" required width="100%" value="<?php echo $row['username']?>">
                <br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" required width="100%" value="<?php echo $row['email']?>">
                <br>
                <label for="phonenumber">Phone Number</label><br>
                <input type="text" name="phonenumber" id="phonenumber" required width="100%" value="<?php echo $row['phonenumber']?>">
                <br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required width="100%" value="<?php echo $row['password']?>" >
                <br>
                <div class="genderI">
                    <label for="male">Gender</label>
                    <input type="radio" name="gender" id="male" value="nam">
                    <label for="male">male</label>
                    <input type="radio" name="gender" id="female" value="nữ">
                    <label for="female">female</label>
                </div>
                <br>
                <button type="submit" name="btn-reg" value="Sign Up">Save</button>
            </form>
        </div>
    </div>
</body>

</html>