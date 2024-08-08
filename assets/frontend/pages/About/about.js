// Sử dụng closure để đóng gói các biến và hàm
let slideIndex = 0;
window. onload = function () {
  slides[slideIndex].style.display = "flex";
  dots[slideIndex].className += " active";
};
// Cache các phần tử DOM
const slides = document.getElementsByClassName("slides");
const dots = document.getElementsByClassName("dot");

// Next/previous controls
function plusSlides(n) {
  showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  let i;
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "flex";
  dots[slideIndex - 1].className += " active";
}
