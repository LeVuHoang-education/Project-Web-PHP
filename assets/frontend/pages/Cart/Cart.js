document.addEventListener("DOMContentLoaded", function ()
{
  var nf = new Intl.NumberFormat();
  var priceElements = document.querySelectorAll("td.price");
  priceElements.forEach(function (element)
  {
    var price = parseInt(element.getAttribute("data-price"), 10);
    element.textContent = nf.format(price);
  });

  var totalElements = document.querySelectorAll("td.ThanhTien");
  totalElements.forEach(function (element)
  {
    var total = parseInt(element.getAttribute("data-total"), 10);
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

    updateSession(input.dataset.itemId, input.value);
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

    updateSession(input.dataset.itemId, input.value);
  }
}
function updateTotal(input)
{
  if (!input)
  {
    console.error("Input element không hợp lệ");
    return;
  }
  var nf = new Intl.NumberFormat();
  var quantity = parseInt(input.value, 10);
  var priceText = input.closest("tr").querySelector("td.price").textContent;
  if (!priceText)
  {
    console.error("Giá trị price không hợp lệ");
    return;
  }
  var price = parseInt(priceText.replace(/[,.]/g, ""), 10);
  var total = quantity * price;

  var thanhTienDiv = input.closest("tr").querySelector("td.ThanhTien");
  thanhTienDiv.textContent = nf.format(total);
}

//update so tong tien
function updateTotalmount()
{
  var nf = new Intl.NumberFormat();
  var total = 0;
  var checkboxes = document.querySelectorAll(
    '.CartContent input[name="choose-order"]:checked'
  );

  checkboxes.forEach(function (checkbox)
  {
    // var thanhTienDiv = checkbox.closest('tr').querySelector('td.ThanhTien');
    // var price = parseInt(thanhTienDiv.getAttribute('data-total'), 10);
    // total += price;
    var quantity = parseInt(
      checkbox.closest("tr").querySelector("input[data-item-id]").value,
      10
    );
    var priceText = checkbox
      .closest("tr")
      .querySelector("td.price").textContent;
    var price = parseInt(priceText.replace(/[,.]/g, ""), 10);
    var thanhTien = quantity * price;

    var thanhTienDiv = checkbox.closest("tr").querySelector("td.ThanhTien");
    thanhTienDiv.textContent = nf.format(thanhTien);

    total += thanhTien;
  });
  document.getElementById("totalamount").textContent = nf.format(total);
}
document.getElementById("choose-all").addEventListener("change", function ()
{
  var isChecked = this.checked;
  var checkboxes = document.querySelectorAll(
    '.CartContent input[name="choose-order"]'
  );

  checkboxes.forEach(function (checkbox)
  {
    checkbox.checked = isChecked;
  });
  updateTotalmount();
});

//ham gui update data len db
function sendDatatoServer()
{
  var cartItems = [];
  var cartRows = document.querySelectorAll(".CartContent");

  cartRows.forEach(function (Rows)
  {
    var id = Rows.querySelector('input[name="Cart-item-id"]').value;
    var quantity = Rows.querySelector('input[type="number"]').value;

    cartItems.push({
      id: id,
      quantity: quantity,
    });
  });

  fetch("./frontend/pages/Update-cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(cartItems),
  })
    .then((response) => response.text())
    .then((data) => console.log(data))
    .catch((error) => console.error("ERROR:", error));
}
//set thoi gian de gui du lieu len db neu nhu co user_id
setTimeout(function ()
{
  sendDatatoServer();
}, 5000); // 60s

// gui data form qua trang thanh toan
document
  .getElementById("checkout-form")
  .addEventListener("submit", function (event)
  {
    event.preventDefault();
    const selectedItems = [];
    const checkboxes = document.querySelectorAll(
      'input[name="choose-order"]:checked'
    );

    checkboxes.forEach(function (checkbox)
    {
      var data = checkbox.closest("tr").querySelector("input[data-item-id]");
      if (data)
      {
        selectedItems.push(data.getAttribute("data-item-id")); // Lấy giá trị của data-item-id
      }
    });

    if (selectedItems.length > 0)
    {
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "selected_cart_ids";
      input.value = selectedItems.join(",");

      this.appendChild(input);
      this.submit();
    } else
    {
      alert("Vui lòng chọn sản phẩm cần mua");
    }
  });

//Update so luong trong session
function updateSession(itemId, quantity)
{
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./frontend/pages/UpdateSession.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function ()
  {
    if (xhr.readyState === 4 && xhr.status === 200)
    {
      console.log("Số lượng đã được cập nhật trong session");
      var input = document.querySelector(
        'input[data-item-id="' + itemId + '"]'
      );
      if (input)
      {
        updateTotal(input);
        updateTotalmount();
      }
    }
  };

  xhr.send("itemId=" + itemId + "&quantity=" + quantity);
}
document.addEventListener('DOMContentLoaded', function ()
{
  updateTotalmount();
});