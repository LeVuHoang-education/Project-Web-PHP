<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/frontend/component/Footer/footer.css" />

</head>

<body>

    <hr class="hr-header">
    <div class="footer">
        <div class="footer-content">

            <div class="footer-gt">
                <h2>Nội Thất NHẬT HOÀNG</h2>
                <ul class="footer-list">
                    <li>
                        <p>Nội Thất NHẬT HOÀNG là thương hiệu đến từ Savimex với gần 40 năm kinh nghiệm trong việc sản xuất và xuất khẩu nội thất đạt chuẩn quốc tế.</p>
                    </li>
                    <li><img src="assets/frontend/img/logo/OIP.jpg" width="60%" height="auto" alt=""></li>
                    <li><img src="assets/frontend/img/Icon/Screenshot 2024-08-11 224535.png" width="60%" height="auto" alt=""> </li>
                </ul>
            </div>
            <div class="footer-aboutus">
                <h2>Về chúng tôi</h2>
                <ul class="footer-list">
                    <li><a href="">
                            Giới thiệu
                        </a>
                    </li>
                    <li>
                        <a href="../../../../index.php?act=DieuKhoan">
                            Điều khoản
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-ttlh">
                <h2>Thông tin liên hệ</h2>
                <ul class="footer-list">
                    <li>
                        <p>Showroom: 162 HT17, P. Hiệp Thành, Q. 12, TP. HCM (Nằm trong khuôn viên công ty SAVIMEX phía sau bến xe buýt Hiệp Thành)</p>
                    </li>
                    <li>
                        <p>Hotline: 0971 141 140</p>
                    </li>
                    <li>
                        <p>Experience Store 1: S05.03-S18 phân khu The Rainbow | Vinhomes Grand Park, TP. Thủ Đức</p>
                    </li>
                    <li>
                        <p>Hotline: 0931 880 424</p>
                    </li>
                    <li>
                        <p>Experience Store 2: S3.03-Sh15 phân khu Sapphire | Vinhomes Smart City, Hà Nội</p>
                    </li>
                    <li>
                        <p>Hotline: 0909 665 728</p>
                    </li>
                    <li>
                        <p>097 114 1140 (Hotline/Zalo)</p>
                    </li>
                    <li>
                        <p>0902 415 359 (Đội Giao Hàng)</p>
                    </li>
                </ul>
            </div>
            <div class="footer-mxh">
                <h2>Biểu tượng mạng xã hội</h2>
                <ul class="footer-list">
                    <li>
                        <a class="mxh" href="#"
                            onmouseover="fover(this)"
                            onmouseout="fout(this)"
                            data-hover-src="assets/frontend/img/Icon/icons8-facebook-50 (1).png"
                            data-out-src="assets/frontend/img/Icon/icons8-facebook-48.png">
                            <img src="assets/frontend/img/Icon/icons8-facebook-48.png" alt="">
                            <p>https://www.facebook.com/noithatnhathoang</p>
                        </a>
                    </li>

                    <li>
                        <a class="mxh" href="#"
                            onmouseover="fover(this)"
                            onmouseout="fout(this)"
                            data-hover-src="assets/frontend/img/Icon/icons8-instagram-64.png"
                            data-out-src="assets/frontend/img/Icon/icons8-instagram-48.png">
                            <img src="assets/frontend/img/Icon/icons8-instagram-48.png" alt="">
                            <p>https://www.instagram.com/noithatnhathoang</p>
                        </a>
                    </li>

                    <li>
                        <a class="mxh" href="#"
                            onmouseover="fover(this)"
                            onmouseout="fout(this)"
                            data-hover-src="assets/frontend/img/Icon/icons8-youtube-50.png"
                            data-out-src="assets/frontend/img/Icon/icons8-youtube-48.png">
                            <img src="assets/frontend/img/Icon/icons8-youtube-48.png" alt="">
                            <p>https://www.youtube.com/channel/UCnO2h4rNp3l_7Y9mKQy5b5Q</p>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="mxh"
                            onmouseover="fover(this)"
                            onmouseout="fout(this)"
                            data-hover-src="assets/frontend/img/Icon/icons8-tiktok-50.png"
                            data-out-src="assets/frontend/img/Icon/icons8-tiktok-48.png">
                            <img src="assets/frontend/img/Icon/icons8-tiktok-48.png" alt="">
                            <p>https://www.tiktok.com/@noithatnhathoang</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">Bản quuyền trang web thuộc về Cty TNHH Nhật Hoàng @ Copyright 2024 - 2024</div>
    </div>
    <script>
        function fover(link) {
            var img = link.querySelector('img');
            var hoverSrc = link.getAttribute('data-hover-src');
            img.src = hoverSrc;
        }

        function fout(link) {
            var img = link.querySelector('img');
            var outSrc = link.getAttribute('data-out-src');
            img.src = outSrc;
        }
    </script>
</body>

</html>