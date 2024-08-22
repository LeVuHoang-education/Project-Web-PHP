document.addEventListener('DOMContentLoaded', function ()
{
    var nf = new Intl.NumberFormat();
    var priceElements = document.querySelectorAll('td.price');
    priceElements.forEach(function (element)
    {
        var price = parseInt(element.getAttribute('data-price'), 10);
        element.textContent = nf.format(price);
    });

    var totalElements = document.querySelectorAll('td.ThanhTien');
    totalElements.forEach(function (element)
    {
        var total = parseInt(element.getAttribute('data-total'), 10);
        element.textContent = nf.format(total);
    });


});
function tang(button)
{
    var input = button.parentNode.querySelector('input[type="number"]');
    var inputValue = parseInt(input.value, 10);

    var max = input.max ? parseInt(input.max, 10) : Infinity;
    if (inputValue < max)
    {
        input.value = inputValue + 1;
        updateTotal(input);
    }
}

function giam(button) 
{
    var input = button.parentNode.querySelector('input[type="number"]');
    var inputValue = parseInt(input.value, 10);

    if (inputValue > 1)
    {
        input.value = inputValue - 1;
        updateTotal(input);
    }
}
function updateTotal(input)
{
    var nf = new Intl.NumberFormat();
    var quantity = parseInt(input.value, 10);
    var priceText = input.closest('td').previousElementSibling.textContent;
    var price = parseInt(priceText.replace(/,/g, ''), 10);
    var total = quantity * price;

    var thanhTienDiv = input.closest('tr').querySelector('td.ThanhTien');
    thanhTienDiv.textContent = nf.format(total);

}
function updateTotalmount()
{
    var nf = new Intl.NumberFormat();
    var total = 0;
    var checkboxes = document.querySelectorAll('.CartContent input[name="choose-order"]:checked');

    checkboxes.forEach(function (checkbox)
    {
        var price = parseInt(checkbox.getAttribute('data-checkbox'), 10);
        total += price;
    });
    document.getElementById('totalamount').textContent = nf.format(total);
}
document.getElementById('choose-all').addEventListener('change', function ()
{
    var isChecked = this.checked;
    var checkboxes = document.querySelectorAll('.CartContent input[name="choose-order"]');

    checkboxes.forEach(function (checkbox)
    {
        checkbox.checked = isChecked;
    });
    updateTotalmount();
});

function sendDatatoServer()
{
    var cartItems = [];
    var cartRows = document.querySelectorAll('.CartContent');

    cartRows.forEach(function (Rows)
    {
        var id = Rows.querySelector('input[name="Cart-item-id"]').value;
        var quantity = Rows.querySelector('input[type="number"]').value;

        cartItems.push({
            id: id,
            quantity: quantity
        });
    })

    fetch("./frontend/pages/Update-cart.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(cartItems)
    })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('ERROR:', error));
}

setTimeout(function ()
{
    sendDatatoServer();
}, 5000); // 60s

document.getElementById('checkout-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const selectedItems = [];
    const checkboxes = document.querySelectorAll('input[name="choose-order"]:checked');

    checkboxes.forEach(function (checkbox) {
        selectedItems.push(checkbox.value);
    });

    if(selectedItems.length > 0 ) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_cart_ids';
        input.value = selectedItems.join(',');
        
        this.appendChild(input);
        this.submit();
    }
    else {
        alert('Vui lòng chọn sản phẩm cần mua');
    }
});