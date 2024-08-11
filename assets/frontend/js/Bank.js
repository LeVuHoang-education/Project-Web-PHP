var addLinking;
var property;
window.onload = function () {
  addLinking = document.getElementsByClassName("add-account-bank");
  property = addLinking[0];
};
function showingLinkingForm() {
  var button = document.getElementById("btn");
  if (property.classList.contains("hidden")) {
    property.classList.remove("hidden");
    property.classList.add("showing");
    button.textContent = "Hủy bỏ";
} else if (property.classList.contains("showing")) {
    property.classList.add("hidden");
    property.classList.remove("showing");
    button.textContent = "Thêm liên kết";
  }
}
