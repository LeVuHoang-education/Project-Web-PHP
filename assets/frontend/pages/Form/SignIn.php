<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/SignIn.css">
</head>

<body style="align-items: center;">
    <div class="main">
        <div class="signIn-container">
            <div class="title">
                <h1> <img class="icon" src="assets/frontend/img/Icon/right-to-bracket-solid.svg"></h1>
                <h2>Sign In</h2>
            </div>
            <hr>
            <form action="../../../../frontend/pages/DangNhap.php" method="POST">
                <div class="groupBox">
                    <label for="email">Email</label><br>
                    <div class="ae">
                        <img class="iconInput" src="assets/frontend/img/Icon/IconEmail.svg">
                        <input type="email" name="email" id="email" required placeholder="Enter your email" width="100%">
                    </div>
                </div>

                <div class="groupBox">
                    <label for="password">Mật khẩu</label><br>
                    <div class="ae">
                        <img class="iconInput" src="assets/frontend/img/Icon/iconPassword.svg">
                        <input type="password" name="password" id="password" required placeholder="Enter your password" width="100%">
                    </div>
                </div>

                <div class="button_t">
                    <button type="submit" name="btn-reg" value="Sign In">Đăng nhập</button><br>
                </div>
                <div class="a_link">
                    <a href="SignUp.php">Đăng kí </a></a>
                    <a href="#">Quên mật khẩu?</a>
                </div>
            </form>
            <hr>
            <img class="logo" src="assets/frontend/img/Icon/support.png">
        </div>
    </div>
</body>

</html>