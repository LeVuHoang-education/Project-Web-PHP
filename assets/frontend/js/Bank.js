document.addEventListener("DOMContentLoaded", executeData);

function executeData() {
  fetch("frontend/src_xml_htm/api_full_bank.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach(bank => {
        
        const bankSelect = document.getElementById("name-bank");
        const option = document.createElement("option");
        option.value = bank.short_name;
        option.textContent = bank.name;
        bankSelect.appendChild(option);
        
      });
    });
}
