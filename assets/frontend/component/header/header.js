window.onload = function () {
  var navbar = document.getElementsByClassName("taskbar-container")[0];
  window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
      navbar.classList.add("sticky");
    } else {
      if (navbar.classList.contains("sticky")) {
        navbar.classList.remove("sticky");
      }
    }
  });
};

function openLoveList() {
  const btn = document.getElementById("open-love-list");
  fetch("./assets/frontend/component/header/handlingOpenLoveList.php", {
    method: "POST",
    body: JSON.stringify({
      userID: "",
    }),
  })
    .then((response) => response.text())
    .then((text) => {
      try {
        const data = JSON.parse(text);
        console.log("Success");
        if (data.message == "notallow") {
          alert("Vui lòng đăng nhập để sử dụng tính năng này!");
        } else {
          var link = document.createElement("a");
          link.href = "../../../../index.php?act=lovelist";
          document.body.appendChild(link);
          link.click();
        }
      } catch (error) {
        console.error(error);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
