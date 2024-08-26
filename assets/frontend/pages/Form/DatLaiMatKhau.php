<style>
    .DLMK_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        width: 100%;
        ;
    }
    .DLMK-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 30%;
        height: 30vh;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .DLMK-form h2 {
        margin-bottom: 20px;
    }
</style>

<div class="DLMK_container">
    <div class="DLMK-form">
        <h2>Đặt lại mật khẩu</h2>
        <form id="forgotPasswordForm" method="post">
            <label for="email">Nhập email của bạn:</label>
            <input type="email" id="email" name="email" required placeholder="Email">
            <button type="submit">Gửi yêu cầu</button>
        </form>
    </div>
</div>