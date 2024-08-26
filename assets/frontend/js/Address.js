function getCities() {
  const url = "https://esgoo.net/api-tinhthanh/1/0.htm";

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data.error === 0) {
        const citySelect = document.getElementById("city-name");
        data.data.forEach((city) => {
          const option = document.createElement("option");
          option.value = city.id;
          option.textContent = city.name;
          citySelect.appendChild(option);
        });
      } else {
        console.error("Error fetching city data:", data.error);
      }
    })
    .catch((error) => console.error("Error fetching city data:", error));
}

function getDistricts(cityId) {
  const url = `https://esgoo.net/api-tinhthanh/2/` + cityId + `.htm`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data.error === 0) {
        const districtSelect = document.getElementById("district-name");
        // districtSelect.innerHTML = ""; // Clear previous options before adding new ones
        data.data.forEach((district) => {
          const option = document.createElement("option");
          option.value = district.id; // Assuming district value is a string
          option.textContent = district.name;
          districtSelect.appendChild(option);
        });
      } else {
        console.error("Error fetching district data:", data.error);
      }
    })
    .catch((error) => console.error("Error fetching district data:", error));
}

function getWards(districtId) {
  const url = `https://esgoo.net/api-tinhthanh/3/` + districtId + `.htm`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      if (data.error === 0) {
        const wardSelect = document.getElementById("ward-name");
        // wardSelect.innerHTML = ""; // Clear previous options
        data.data.forEach((ward) => {
          const option = document.createElement("option");
          option.value = ward.id; // Assuming ward has an id property
          option.textContent = ward.name; // Assuming ward value is a string
          wardSelect.appendChild(option);
        });
      } else {
        console.error("Error fetching ward data:", data.error);
      }
    })
    .catch((error) => console.error("Error fetching ward data:", error));
}

// Call getCities() when the document is ready
document.addEventListener("DOMContentLoaded", getCities);

// Attach event listeners to city and district selects
const citySelect = document.getElementById("city-name");
citySelect.addEventListener("change", function () {
  cityId = this.value;
  getDistricts(cityId);
});

const districtSelect = document.getElementById("district-name");
districtSelect.addEventListener("change", function () {
  districtId = this.value;
  getWards(districtId);
});
