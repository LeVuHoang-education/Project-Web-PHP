<div class="banner-brand">
    <div class="title">NHẬT HOÀNG - NỘI THẤT GIA ĐÌNH PHONG CÁCH HIỆN ĐẠI SỐ 10 VIỆT NAM</div>
    <div class="individual">
        <div class="love-list">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
            </a>
        </div>
        <div class="backet">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                </svg>
            </a>
        </div>
        <div id="account">
            <a class="signIn" href="../../pages/Form/SignIn.php">Đăng nhập</a>
            <a class="signUp" href="#">/Đăng ký</a>
        </div>
    </div>
</div>
<hr />

<div class="header">
    <div class="intro-brand">
        <div class="logo">
            <img class="thumbnail-brand" src="../../src/Home/LogoFA.png" alt="Logo" />
        </div>
        <div class="title-brand">
            <a href="../../pages/home/home.php"><img src="../../src/header/banner.png"/></a>
        </div>
        <div class="image-brands">
            <img id="image-brand" src="../../src/Home/LogoFA.png" alt="Image" />
            <img id="image-brand" src="../../src/Home/LogoFA.png" alt="Image" /><br />
            <img id="image-brand" src="../../src/Home/SnoopyGaming.jpg" alt="Image" />
            <img id="image-brand" src="../../src/Home/space-themed-gaming-logo-template-3274.png" alt="Image" />
        </div>
    </div>
</div>
<hr />
<!--taskbar-->
<div class="taskbar">
    <div class="navbar">
        <?php

        require('../../../../db/connect.php');
        $sql = "SELECT * FROM category";
        $listCategory = $conn->query($sql);

        ?>
        <ul>
            <li>
                <a href="../../../frontend/pages/home/home.php">Trang chủ</a>
            </li>
            <li>
                <a href="#">Danh sách</a>
                <ul class="sub-navbar">
                    <?php
                    while ($row = $listCategory->fetch_assoc()) {
                    ?>
                        <li>
                            <a href="../../pages/ProductList/productList.php?category=<?php echo $row['catid'] ?>">
                                <?php echo $row['catname'] ?>
                            </a>
                        </li>
                    <?php
                    };
                    ?>
                </ul>
            </li>
            <li>
                <a href="#">Giá sốc</a>
                <ul class="sub-navbar">
                    <li><a href="#">Ưu đãi thành viên</a></li>
                    <li><a href="#">Ngày lễ siêu rẻ</a></li>
                    <li><a href="#">Ngày hội mua sắm</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Dịch vụ</a>
            </li>
            <li>
                <a href="#">Hỗ trợ</a>
            </li>
            <li>
                <a href="../../pages/About/about.php">Giới thiệu</a>
            </li>
            <li>
                <a href="#">Tài khoản</a>
            </li>
        </ul>
    </div>
</div>
<hr />