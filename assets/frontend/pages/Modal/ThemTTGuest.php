<div id="modal_themNH" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="modal4">&times;</span>
        <h2>Điền thông tin</h2>
        <form action="../../../../frontend/pages/ThemttGuest.php" method="post">
            <div class="modalbox-guest">
                <label for="guestname">Nhập tên</label>
                <input type="text" name="guestname" id="guestname" required>
            </div>

            <div class="modalbox-guest">
                <label for="guestphone">Nhập số điện thoại</label>
                <input type="text" name="guestphone" id="guestphone" required>
            </div>

            <div class="modalbox-guest">
                <label for="guestaddress">Nhập địa chỉ nhận hàng</label>
                <input type="text" name="guestaddress" id="guestaddress" required>
            </div>
            <div class="modalbox-guest">
                <label for="">Phương thức thanh toán</label>
                <select name="" id="" disabled>
                    <option value="" selected>Thanh toán khi nhận hàng</option>
                </select>
            </div>
            <div class="modalbox-guest-btn">
                <button type="submit" value="ThemTTGuest">Hoàn tất</button>
            </div>
        </form>
    </div>
</div>