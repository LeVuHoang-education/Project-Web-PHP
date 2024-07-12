<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SignUp.css">
    <title>Sign Up</title>
</head>

<body>
    <form action="Dangki.php" method="post">
        <div class="container">
            <h1>Sign Up</h1>
            <hr>
            <fieldset class="formSU">
                <legend>Fill this form to sign up</legend>
                <div>
                    <label for="username">User name</label><br>
                    <input type="text" placeholder="Enter Username" name="username" required>
                </div>
                <div>
                    <label for="email">Email</label><br>
                    <input type="email" placeholder="Enter Email" name="email" required>
                </div>
                <div>
                    <label for="phonenumber">Phone number</label><br>
                    <input type="text" placeholder="Enter Phone number" name="phonenumber" required>
                </div>
                <div>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" required placeholder="Enter password" ">
                </div>
                <div class="clear">
                    <label for=" gender">Gender</label><br>
                    <input type="radio" name="gender" value="male" id="male">
                    <label for="male">male</label>
                    <input type="radio" name="gender" value="female" id="female">
                    <label for="female">female</label>
                </div>
                <div>
                    <button type="submit" value="Dangki" name="btn-reg  ">Sign Up</button><br>
                    <a href="login.php">Already have an account? Login</a>
                </div>

            </fieldset>

        </div>
    </form>
</body>

</html>