<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SignUp.css">
</head>
<body style="align-items: center;">
    <div class="main">
        <div class="containner">
            <h1> <img class="icon" src="../../img/Icon/SignUpIcon.png"></h1>
            <h2>Điền biểu mẫu để đăng kí</h2>
            <hr>
            <form action="../../../../fontend/pages/DangKi.php" method="post">
                <label for="username">Tên đăng nhập</label><br>
                <input type="text" name="username" id="username" placeholder="Enter user name" required width="100%">
                <br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Enter your email" required width="100%">
                <br>
                <label for="phonenumber">Số điện thoại</label><br>
                <input type="text" name="phonenumber" id="phonenumber" required width="100%" placeholder="Enter your phone number">
                <br>
                <label for="password">Mật khẩu</label><br>
                <input type="password" name="password" id="password" placeholder="Enter your password" required width="100%">
                <br>
                <div class="genderI">
                    <label for="male">Giới tính</label>
                    <input type="radio" name="gender" id="male" value="nam">
                    <label for="male">Nam</label>
                    <input type="radio" name="gender" id="female" value="nữ">
                    <label for="female">Nữ</label>
                </div>
                <br>
                <button type="submit" name="btn-reg" value="Sign Up">Đăng kí </button>
                <a href="SignIn.php">Đã có tài khoản? Đăng nhập</a>
            </form>
        </div>
    </div>
</body>

</html>