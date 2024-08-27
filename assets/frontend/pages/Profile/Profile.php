<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/frontend/css/Profile.css">
    <link rel="stylesheet" href="assets/frontend/component/Aside/Aside.css" />
    <title>Tài khoản</title>
</head>

<body>
    <div class="container-profile">
        <div class="form-group">
            <?php include 'assets/frontend/component/Aside/AsideProfile.php'; ?>
            <?php
            echo "<div class='profile-content'>";
            if (isset($_GET['act'])) {
                if ($_GET['act'] == 'account') {
                    if (isset($_SESSION['user_id'])) {
                        switch ($_GET['feature']) {
                            case 'brief':
                                include 'assets/frontend/pages/Profile/brief.php';
                                break;
                            case 'bank':
                                include 'assets/frontend/pages/Profile/bank.php';
                                break;
                            case 'address':
                                include 'assets/frontend/pages/Profile/DiaChi.php';
                                break;
                            case 'changePassword':
                                include 'assets/frontend/pages/Profile/Doimk.php';
                                break;
                            case 'order':
                                include 'assets/frontend/pages/Profile/Donhang.php';
                                break;
                            default:
                                include 'assets/frontend/pages/Profile/brief.php';
                                break;
                        }
                    }
                } else {
                    echo "<h3>Bạn chưa đăng nhập</h3>";
                }
                echo "</div>";
            }
            ?>

        </div>
    </div>
</body>

</html>