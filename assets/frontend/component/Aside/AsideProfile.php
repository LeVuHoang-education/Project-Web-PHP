<Aside>
    <div class="aside-profile">
        <div class="aside-profile__avatar">
            <img src="assets/frontend/img/Icon/user.png" width="30px" height="30px" alt="Avatar">
        </div>
        <div class="aside-profile__info">
            <h3 class="aside-profile__name">
                <?php
                require "frontend/global/variable.php";
                echo $nameAccount;
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
        <div class="submenu" id="submenuProfile">
            <a href="../../../../index.php?act=account&feature=brief">Hồ sơ</a>
            <a href="../../../../index.php?act=account&feature=bank ">Ngân hàng</a>
            <a href="../../../../index.php?act=account&feature=address">Địa chỉ</a>
            <a href="../../../../index.php?act=account&feature=changePassword">Đổi mật khẩu</a>
        </div>
        <div class="aside-don-mua">
            <img src="assets/frontend/img/Icon/cargo.png" width="40px" height="40px">
            <a id="btn" href="../../../../index.php?act=account&feature=order">
                <span>Đơn Mua</span>
            </a>
        </div>
    </div>
</Aside>