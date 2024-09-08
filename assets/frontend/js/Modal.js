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
                if (data.redirect)
                {
                    window.location.href = data.redirect;
                } else
                {
                    // Đăng nhập thành công và cập nhật trạng thái người dùng
                    document.getElementById('popupLogin').style.display = 'none';
                    location.reload();
                }
            } else
            {

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

    var password = document.getElementById('password').value;
    var passwordError = document.getElementById('passwordError');
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

    var email = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    var emailRegex = /.+\..+/;

    if (!passwordRegex.test(password))
    {
        passwordError.style.display = 'block';
        return;
    } else
    {
        passwordError.style.display = 'none';
    }

    if (!emailRegex.test(email))
    {
        emailError.style.display = 'block';
        return;
    } else
    {
        emailError.style.display = 'none';
    }

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
                document.getElementById('popupSignUp').style.display = 'none';
                location.reload();
            } else
            {

                alert(data.message);
            }
        })
        .catch(error =>
        {
            console.error('Error:', error);
        });
});