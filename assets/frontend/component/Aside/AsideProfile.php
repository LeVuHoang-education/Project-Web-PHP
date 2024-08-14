<Aside>
    <div class="aside-profile">
        <div class="aside-profile__avatar">
            <img src="assets/frontend/img/Icon/user.png" width="30px" height="30px" alt="Avatar">
        </div>
        <div class="aside-profile__info">
            <h3 class="aside-profile__name">
                <?php
                include './frontend/global/variable.php';
                if ($nameAccount) {
                    echo $nameAccount;
                } else echo "Unknown Account";
                ?>
            </h3>
        </div>
        <hr class="aside-hr" />
    </div>
    <div class="aside-menu">
        <div class="aside-profile-menu" data-target="submenuProfile">
            <img src="assets/frontend/img/Icon//user (1).png" width="40px" height="40px" alt="">
            <span>Tài khoản của tôi</span>
        </div>
        <?php
        if (isset($_SESSION['user_id'])) {
        ?>
            <div class="submenu" id="submenuProfile">
                <a href="../../../../index.php?act=account&feature=brief">Hồ sơ</a>
                <a href="../../../../index.php?act=account&feature=bank ">Ngân hàng</a>
                <a href="../../../../index.php?act=account&feature=address">Địa chỉ</a>
                <a href="../../../../index.php?act=account&feature=changePassword">Đổi mật khẩu</a>
                <a href="../../../../index.php">Đăng xuất</a>
            </div>
            <div class="aside-don-mua">
                <img src="assets/frontend/img/Icon/cargo.png" width="40px" height="40px">
                <a id="btn" href="../../../../index.php?act=account&feature=order">
                    <span>Đơn Mua</span>
                </a>
            </div>
        <?php
        } else {
        ?>
            <div class="submenu" id="submenuProfile">
                <a href="../../../../index.php?act=signIn">Đăng nhập</a>
                <a href="../../../../index.php?act=signUp ">Đăng kí</a>
            </div>
        <?php
        }
        ?>
    </div>
</Aside>