function getBanks() {
  const url = "https://api.viqr.net/list-banks/";
  fetch(url)
    .then((reponse) => reponse.json())
    .then((data) => {
      if (data.error === 0) {
        const bankSelect = document.getElementById("name-bank");
        data.data.forEach((bank) => {
          const option = document.createElement("option");
          option.value = bank.id;
          option.textContent = bank.name;
          bankSelect.appendChild(option);
        });
      } else {
        console.error("Error fetching bank data: ",error);
      }
    })
    .catch((error) => console.error("Error fetching bank data:", error));
}

document.addEventListener("DOMContentLoaded", getBanks);
