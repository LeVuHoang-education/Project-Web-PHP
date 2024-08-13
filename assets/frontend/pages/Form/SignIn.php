<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SignIn.css">
    <title>Sign In</title>
</head>

<body style="align-items: center;">
    <div class="main">
        <div class="containner">
            <h1> <img class="icon" src="../../img/Icon/right-to-bracket-solid.svg"></h1>
            <h2>Sign In</h2>
            <hr>
            <form action="../../../../frontend/pages/DangNhap.php" method="POST">
                <div class="groupBox">
                    <label for="email">Email</label><br>
                    <div class="ae">
                        <img class="iconInput" src="../../img/Icon/IconEmail.svg">
                        <input type="email" name="email" id="email" required placeholder="Enter your email" width="100%">
                    </div>
                </div>

                <div class="groupBox">
                    <label for="password">Password</label><br>
                    <div class="ae">
                        <img class="iconInput" src="../../img/Icon/iconPassword.svg">
                        <input type="password" name="password" id="password" required placeholder="Enter your password" width="100%">
                    </div>
                </div>

                <div class="button_t">
                    <button type="submit" name="btn-reg" value="Sign In">Sign In</button><br>
                </div>
                <div class="a_link">
                    <a href="SignUp.php">Sign Up</a></a>
                    <a href="#">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>