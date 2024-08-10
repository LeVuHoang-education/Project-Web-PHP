<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/Profile.css">
    <link rel="stylesheet" href="../../component/header/header.css" />
    <link rel="stylesheet" href="../../component/Footer/Footer.css" />
    <link rel="stylesheet" href="../../component/Aside/Aside.css" />
    <title>Document</title>
</head>

<body>
    <?php include("../../component/header/header.php"); ?>
    <div class="container">
        <?php include("../../component/Aside/AsideProfile.php"); ?>
        <div class="Profile-container">
            <form action="" class="formpro">
                <div class="Profile-header">
                    <h3>Hồ sơ của tôi</h3>
                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                </div>
                <hr class="vachpro">
                <div class="main-container">
                    <div class="tttrai">
                        <table>
                            <tr>
                                <td> <label for="TDN">Tên đăng nhập</label></td>
                                <td> <input type="text" id="TDN" name="TDN" placeholder="Tên đăng nhập" value="BN21102002"></td>
                            </tr>

                            <tr>
                                <td><label for="email">Email</label></td>
                                <td> <input type="email" name="email" id="email" value="2251120349@ut.edu.vn"></td>
                            </tr>

                            <tr>
                                <td> <label for="phonenumber">Số điện thoại</label></td>
                                <td> <input type="text" name="phonenumber" id="phonenumber" value="0987654321"></td>

                            </tr>

                            <tr>
                                <td><label for="gender">Giới tính</label></td>
                                <td>
                                    <input type="radio">nam
                                    <input type="radio">nữ
                                </td>
                            </tr>


                            <tr>
                                <td><label for="birthday">Ngày sinh</label></td>
                                <td><input type="date" name="birthday" id="birthday" value="2002-10-21"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="profilephai">
                        <div class="vertical-line"></div>
                        <div class="Profilespace">
                            <img src="../../img/Icon/user.png" width="80px" height="auto" alt="logo.png">
                            <div class="file-input-container">
                                <label class="custom-file-label" for="file-input">Chọn ảnh</label>
                                <input type="file" id="file-input" class="file-input">
                            </div>
                            <p>Dụng lượng file tối đa 1 MB <br>
                                Định dạng:.JPEG, .PNG</p>
                        </div>
                    </div>
                </div>
                <div class="btnpro">
                    <button type="submit" name="btn-reg" value="Sign Up">Lưu</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.getElementById('file-input').addEventListener('change', function(event) {
            const input = event.target;
            const label = input.nextElementSibling;
            const fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
            label.textContent = fileName;
        });
    </script>
    <?php include("../../component/footer/footer.php"); ?>
</body>

</html>