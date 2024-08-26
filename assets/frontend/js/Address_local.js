var cityId;
var districtId;
var wardId;
document.addEventListener("DOMContentLoaded", executeData); // Corrected function name

function executeData() {
  fetch("frontend/src_xml_htm/api_full.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((city) => {
        const citySelect = document.getElementById("city-name");
        const option = document.createElement("option");
        option.value = city.name;
        option.textContent = city.name;
        citySelect.appendChild(option);
      });
    });
}
function getDistricts(cityId) {
  fetch("frontend/src_xml_htm/api_full.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((city) => {
        if (city.name === cityId) {
          city.data2.forEach((district) => {
            const districtSelect = document.getElementById("district-name");
            const option = document.createElement("option");
            option.value = district.name;
            option.textContent = district.name;
            districtSelect.appendChild(option);
          });
        }
      });
    });
}

function getWards(districtId) {
  fetch("frontend/src_xml_htm/api_full.json")
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((city) => {
        if (city.name === cityId) {
          city.data2.forEach((district) => {
            if (district.name === districtId) {
              district.data3.forEach((ward) => {
                const wardSelect = document.getElementById("ward-name");
                // wardSelect.innerHTML = ""; // Clear previous options (optional)
                const option = document.createElement("option");
                option.value = ward.name; // Assuming ward has an id property
                option.textContent = ward.name; // Assuming ward value is a string
                wardSelect.appendChild(option);
              });
            }
          });
        }
      });
    });
}

const citySelect = document.getElementById("city-name");
const districtSelect = document.getElementById("district-name");
const wardSelect = document.getElementById("ward-name");
citySelect.addEventListener("change", function () {
  cityId = this.value;

  districtSelect.innerHTML = ""; // Clear previous options (optional)
  const option = document.createElement("option");
  option.value = "none"; // Assuming ward has an id property
  option.textContent = "Chọn Quận/Huyện "; // Assuming ward value is a string
  districtSelect.appendChild(option);

  getDistricts(cityId);
});

districtSelect.addEventListener("change", function () {
  districtId = this.value;

  wardSelect.innerHTML = ""; // Clear previous options (optional)
  const option = document.createElement("option");
  option.value = "none"; // Assuming ward has an id property
  option.textContent = "Chọn Xã/Phường/Thị Trấn "; // Assuming ward value is a string
  wardSelect.appendChild(option);

  getWards(districtId);
});
