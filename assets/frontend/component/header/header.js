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
