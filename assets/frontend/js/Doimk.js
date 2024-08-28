document.querySelector('.formDoimk').addEventListener('submit', function (event) {
    event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

    var oldPassword = document.getElementById('oldpassword').value;
    var newPassword = document.getElementById('newpassword').value;
    var renewPassword = document.getElementById('renewpassword').value;
    var errorMessages = [];

    // Kiểm tra mật khẩu cũ
    fetch('../../../../frontend/pages/Checkmk.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ oldpassword: oldPassword })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.valid) {
            errorMessages.push('Mật khẩu cũ không chính xác.');
            displayErrors(errorMessages);
        } else {
            // Kiểm tra mật khẩu mới
            if (newPassword !== renewPassword) {
                errorMessages.push('Mật khẩu mới và nhập lại mật khẩu mới không khớp.');
            }

            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRegex.test(newPassword)) {
                errorMessages.push('Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm 1 chữ cái viết hoa, 1 chữ cái viết thường và 1 số.');
            }

            if (errorMessages.length > 0) {
                displayErrors(errorMessages);
            } else {
                // Gửi yêu cầu đổi mật khẩu mới
                fetch('../../../../frontend/pages/Doimk.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        oldpassword: oldPassword,
                        newpassword: newPassword
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Mật khẩu đã được cập nhật thành công.');
                        window.location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    function displayErrors(messages) {
        alert(messages.join('\n'));
    }
});