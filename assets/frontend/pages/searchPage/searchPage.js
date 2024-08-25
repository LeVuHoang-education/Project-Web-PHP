function changeValue() {
  const minRange = document.getElementById("min-range");
  const maxRange = document.getElementById("max-range");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");

  var nf = new Intl.NumberFormat();

  minValue.textContent = nf.format(minRange.value);
  maxValue.textContent = nf.format(maxRange.value);
}
function checkValue() {
  const minRange = document.getElementById("min-range");
  const maxRange = document.getElementById("max-range");
  if (parseInt(minRange.value) >= parseInt(maxRange.value)) {
    alert("Giá trị mà bạn chọn không hợp lệ! Vui lòng chọn lại.");
    return false;
  }
  return true;
}
