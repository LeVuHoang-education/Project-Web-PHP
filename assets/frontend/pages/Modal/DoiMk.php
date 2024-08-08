<div id="modal_doimk" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="modal1">&times;</span>
        <h2>Thay đổi mật khẩu</h2>
        <form action="fontend/pages/Doimk.php" method="post">
            <input type="">
            <div class="input-group-">
                <label for="password">Mật khẩu cũ</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input-group">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="input-group">
                <label for="re_new_password">Nhập lại mật khẩu mới</label>
                <input type="password" name="re_new_password" id="re_new_password" required>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="doimk">Lưu</button>
            </div>
        </form>
    </div>
</div>