document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll("#slider .slide");
  let index = 0;

  setInterval(() => {
    slides[index].classList.remove("opacity-100");
    slides[index].classList.add("opacity-0");

    index = (index + 1) % slides.length;

    slides[index].classList.remove("opacity-0");
    slides[index].classList.add("opacity-100");
  }, 4000);
});
