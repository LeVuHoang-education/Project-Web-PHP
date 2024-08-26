//Thao tac pop up login
// document.querySelector('.signIn').addEventListener('click', function(event) {
//     event.preventDefault(); // Ngăn không cho link chuyển hướng
//     document.getElementById('popupLogin').style.display = 'flex';
// });
// document.getElementById('closePopupLogin').addEventListener('click', function() {
//     document.getElementById('popupLogin').style.display = 'none';
// });


// window.addEventListener('click', function(event) {
//     if (event.target === document.getElementById('popupLogin')) {
//         document.getElementById('popupLogin').style.display = 'none';
//     }
// });
let zIndexCounter = 10000;
function openModal(modalId)
{
    // document.getElementById(modalId).style.display = 'flex';
    const openModals = document.querySelectorAll('.popup[style*="display: flex"]');
    openModals.forEach(modal =>
    {
        modal.style.zIndex = zIndexCounter - 1;
    });

    const modal = document.getElementById(modalId);
    modal.style.display = 'flex';
    modal.style.zIndex = zIndexCounter;
    zIndexCounter++;
}
function closeModal(modalId)
{
    document.getElementById(modalId).style.display = 'none';
}
document.querySelectorAll('[data-modal]').forEach(button =>
{
    button.addEventListener('click', function (event)
    {
        event.preventDefault();
        openModal(this.getAttribute('data-modal'));
    });
});
document.querySelectorAll('.popup-close').forEach(button =>
{
    button.addEventListener('click', function ()
    {
        closeModal(this.closest('.popup').id);
    });
});
window.addEventListener('click', function (event)
{
    if (event.target.classList.contains('popup'))
    {
        closeModal(event.target.id);
    }
});



document.querySelector('.popup-formlogin').addEventListener('submit', function (event)
{
    event.preventDefault();

    var formData = new FormData(this);

    fetch('../../../../frontend/pages/DangNhap.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data =>
        {
            if (data.success)
            {
                // Đăng nhập thành công: tắt popup và cập nhật trạng thái
                document.getElementById('popupLogin').style.display = 'none';
                location.reload();
                // Cập nhật trạng thái người dùng
                //document.getElementById('account').innerHTML = '<a class="current" href="../../../../index.php?act=account&feature=order">Xin chào, ' + formData.get('username') + '</a>';
            } else
            {
                // Hiển thị lỗi nếu đăng nhập không thành công
                alert(data.message);
            }
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
});

document.querySelector('.popup-formsignup').addEventListener('submit', function (event)
{
    event.preventDefault();

    var formData = new FormData(this);

    fetch('../../../../frontend/pages/DangKi.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data =>
        {
            if (data.success)
            {
                // Đăng nhập thành công: tắt popup và cập nhật trạng thái
                document.getElementById('popupSignUp').style.display = 'none';
                location.reload();
                // Cập nhật trạng thái người dùng
                //document.getElementById('account').innerHTML = '<a class="current" href="../../../../index.php?act=account&feature=order">Xin chào, ' + formData.get('username') + '</a>';
            } else
            {
                // Hiển thị lỗi nếu đăng nhập không thành công
                alert(data.message);
            }
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
});