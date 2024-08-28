document.addEventListener("DOMContentLoaded", executeData);

function executeData() {
  fetch("frontend/src_xml_htm/api_full_bank.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((bank) => {
        const bankSelect = document.getElementById("bank-name");
        const option = document.createElement("option");
        option.value = bank.short_name;
        option.textContent = bank.name;
        bankSelect.appendChild(option);
      });
    });
}

function getShortName(idBank) {
  fetch("frontend/src_xml_htm/api_full_bank.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((bank) => {
        if (bank.short_name == idBank) {
          var bankShortName = document.getElementById("bank-short-name");
          bankShortName.value = bank.shortName;
          bankShortName.disabled = true;
          return;
        }
      });
    });
}

const bankName = document.getElementById("bank-name");

bankName.addEventListener("change", function () {
  getShortName(this.value);
});
