<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/frontend/component/header/header.css" />

</head>

<body>
    <div class="header-container">
        <div class="banner-brand">
            <div class="title">NHẬT HOÀNG - NỘI THẤT GIA ĐÌNH PHONG CÁCH HIỆN ĐẠI SỐ 10 VIỆT NAM</div>
            <div class="individual">
                <div class="love-list">
                    <a href="../../../../index.php?act=shopping&feature=loveList">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                        </svg>
                    </a>
                </div>
                <div class="backet">
                    <a href="../../../../index.php?act=GioHang">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                        </svg>
                    </a>
                </div>
                <div id="account">
                    <?php
                    session_start();
                    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != null) {
                        $userid = $_SESSION["user_id"];
                        include "db/connect.php";
                        include "frontend/global/variable.php";
                        $stmt = $conn->prepare("SELECT * FROM account WHERE userid = ?");
                        $stmt->bind_param("i", $userid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();

                        $nameAccount = $user['username'];

                    ?>
                        <a class="current" href='../../../../index.php?act=account&feature=order'><?php echo $nameAccount ?></a>
                    <?php
                        $stmt->close();
                        $conn->close();
                    } else { ?>
                        <a class="signIn" href="assets/frontend/pages/Form/SignIn.php">Đăng nhập</a>
                        <a class="signUp" href="#">/Đăng ký</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <hr class="hr-header">

        <div class="header">
            <div class="intro-brand">
                <div class="logo">
                    <img class="thumbnail-brand" src="./assets/frontend/src/Home/LogoFA.png" alt="Logo" />
                </div>
                <div class="title-brand">
                    <a href="../../pages/home/home.php"><img src="./assets/frontend/src/header/banner.png" width="100%" height="auto" /></a>
                </div>
                <div class="image-brands">
                    <img id="image-brand" src="./assets/frontend/src/Home/LogoFA.png" alt="Image" />
                    <img id="image-brand" src="./assets/frontend/src/Home/LogoFA.png" alt="Image" /><br />
                    <img id="image-brand" src="./assets/frontend/src/Home/SnoopyGaming.jpg" alt="Image" />
                    <img id="image-brand" src="./assets/frontend/src/Home/space-themed-gaming-logo-template-3274.png" alt="Image" />
                </div>
            </div>
        </div>
        <hr class="hr-header">
        <!--taskbar-->
        <div class="taskbar-container">
            <div class="taskbar">
                <div class="navbar">
                    <?php

                    require './db/connect.php';
                    $sql = "SELECT * FROM category";
                    $listCategory = $conn->query($sql);

                    ?>
                    <ul class="ALL-navbar">
                        <li class="navbar-item">
                            <a href="../../../../index.php">Trang chủ</a>
                            <div class="underline"></div>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Danh sách <span class="arrow">&#8744;</span></a>

                            <ul class="navbar-submenu">
                                <?php
                                include "./frontend/global/variable.php";
                                $minPrice = 0;
                                $maxPrice = 0;
                                while ($row = $listCategory->fetch_assoc()) {
                                ?>
                                    <li>
                                        <a href="../../../../index.php?act=productList&cat=<?php echo $row['catid'] ?>">
                                            <?php echo $row['catname'] ?>
                                        </a>
                                    </li>
                                <?php
                                };
                                ?>
                            </ul>
                            <div class="underline"></div>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Giá sốc <span class="arrow">&#8744;</span></a>

                            <ul class="navbar-submenu">
                                <li><a href="#">Ưu đãi thành viên</a></li>
                                <li><a href="#">Ngày lễ siêu rẻ</a></li>
                                <li><a href="#">Ngày hội mua sắm</a></li>
                            </ul>
                            <div class="underline"></div>
                        </li>
                        <li class="navbar-item">
                            <a href="#">Dịch vụ <span class="arrow">&#8744;</span></a>

                            <ul class="navbar-submenu">
                                <li><a href="../../../../index.php?act=chinh-sach-ban-hang">Chính Sách Bán Hàng</a></li>
                                <li><a href="../../../../index.php?act=giao-hang-va-lap-dat">Chính Sách Giao Hàng & Lắp Đặt</a></li>
                                <li><a href="../../../../index.php?act=chinh-sach-doi-tra">Chính Sách Đổi Trả</a></li>
                                <li><a href="../../../../index.php?act=chinh-sach-bao-hanh">Chính Sách Bảo Hành & Bảo Trì</a></li>
                            </ul>
                            <div class="underline"></div>
                        </li>
                        <li class="navbar-item">
                            <a href="../../../../index.php?act=about">Giới thiệu</a>
                            <div class="underline"></div>
                        </li>
                        <li class="navbar-item">
                            <a href="../../../../index.php?act=account&feature=brief">Tài khoản</a>
                            <div class="underline"></div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <script src="./assets/frontend/component/header/header.js"></script>
</body>

</html>