<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/brief.css">
</head>

<body>
    <?php if (isset($_SESSION['user_id'])) { ?>
        <form action="frontend/pages/UpdateInfo.php" class="formpro">
            <div class="profile-header">
                <h3>Hồ sơ của tôi</h3>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            </div>
            <hr class="vachpro">

            <?php $id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `account` WhERE userid=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row["userid"];
            $email = $row["email"];
            $username = $row["username"];
            $phonenumber = $row["phonenumber"];
            ?>

            <div class="main-content">
                <div class="tttrai">
                    <div class="field-form">
                        <label for="TDN">Tên đăng nhập</label>
                        <input type="text" id="TDN" name="TDN" placeholder="Tên đăng nhập" value="<?= $username ?>" disabled>
                        <input type="hidden" name="userid" value="<?= $id ?>">;
                    </div>
                    <div class="field-form">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= $email ?>">
                    </div>
                    <div class="field-form">
                        <label for="phonenumber">Số điện thoại</label>
                        <input type="text" name="phonenumber" id="phonenumber" value="<?= $phonenumber ?>">
                    </div>
                    <div class="field-form">
                        <label>Giới tính</label>
                        <input type="radio" name="gender" value="male" <?php if ($row['gender'] == 'nam') echo "checked"; ?>>nam
                        <input type="radio" name="gender" value="female" <?php if ($row['gender'] == 'nữ') echo "checked"; ?>>nữ
                    </div>
                    <div class="field-form">
                        <?php $id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `ttkh` WhERE userid=$id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        if ($row != null) {
                            $birthday = $row["bidthday"];
                        } else $birthday = "";
                        ?>
                        <label for="birthday">Ngày sinh</label>
                        <input type="date" name="birthday" id="birthday" value="<?= $birthday ?>">
                    </div>
                </div>
                <div class="profilephai">
                    <div class="vertical-line"></div>
                    <div class="Profilespace">
                        <img src="assets/frontend/img/Icon/user.png" width="80px" height="auto" alt="logo.png">
                        <div class="file-input-container">
                            <label class="custom-file-label" for="file-input">Chọn ảnh</label>
                            <input type="file" id="file-input" class="file-input">
                        </div>
                        <p>Dụng lượng file tối đa 1 MB <br>
                            Định dạng:.jpeg, .png</p>
                    </div>
                </div>
            </div>
            <div class="btnpro">
                <button id="btn" type="submit" name="btn-reg" value="Sign Up">Lưu</button>
            </div>
        </form>
    <?php } ?>
    <script>
        document.getElementById('file-input').addEventListener('change', function(event) {
            const input = event.target;
            const label = input.nextElementSibling;
            const fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
            label.textContent = fileName;
        });
    </script>
</body>

</html>