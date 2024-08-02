<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SignUp.css">


    <title>Sign Up</title>
</head>

<body style="align-items: center;">
    <div class="main">
        <div class="containner">

            <h1> <img class="icon" src="../../img/Icon/SignUpIcon.png"></h1>
            <h2>Fill this form to sign up</h2>
            <hr>
            <form action="../../../../fontend/pages/DangKi.php" method="post">
                <label for="username">User name</label><br>
                <input type="text" name="username" id="username" placeholder="Enter user name" required width="100%">
                <br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Enter your email" required width="100%">
                <br>
                <label for="phonenumber">Phone Number</label><br>
                <input type="text" name="phonenumber" id="phonenumber" required width="100%" placeholder="Enter your phone number">
                <br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="Enter your password" required width="100%">
                <br>
                <div class="genderI">
                    <label for="male">Gender</label>
                    <input type="radio" name="gender" id="male" value="nam">
                    <label for="male">male</label>
                    <input type="radio" name="gender" id="female" value="nữ">
                    <label for="female">female</label>
                </div>
                <br>
                <button type="submit" name="btn-reg" value="Sign Up">Sign Up</button>
                <a href="SignIn.php">Already have an account? Sign in</a>
            </form>
        </div>
    </div>
</body>

</html>