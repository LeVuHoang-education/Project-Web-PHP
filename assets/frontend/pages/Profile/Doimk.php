<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/Doimk.css">
    <title>Document</title>
</head>

<body>
    <div class="DoimkCon">
        <form method="post" class="formDoimk">
            <div class="DoimkHeader">
                <h3>Đổi mật khẩu</h3>
            </div>
            <hr class="DoimkHR">
            <div class="DoimkForm">
                <div class="DoimkFormInput">
                    <label for="oldpassword">Mật khẩu cũ</label>
                    <input type="password" name="oldpassword" id="oldpassword">
                </div>
                <div class="DoimkFormInput">
                    <label for="newpassword">Mật khẩu mới</label>
                    <input type="password" name="newpassword" id="newpassword">
                </div>
                <div class="DoimkFormInput">
                    <label for="renewpassword">Nhập lại mật khẩu mới</label>
                    <input type="password" name="renewpassword" id="renewpassword">
                </div>
            </div>
            <div class="DoimkButton">
                <button id="btn" type="submit">Lưu</button>
            </div>
        </form>
    </div>
</body>

</html>