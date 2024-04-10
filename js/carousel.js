document.addEventListener("DOMContentLoaded", function () {
  const carouselSlide = document.querySelector(".carousel-slide");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");
  const slides = document.querySelectorAll(".carousel-slide img");

  let counter = 1;
  const slideWidth = slides[0].clientWidth;

  carouselSlide.style.transform = "translateX(" + -slideWidth * counter + "px)";

  nextBtn.addEventListener("click", () => {
    if (counter >= slides.length - 1) return;
    carouselSlide.style.transition = "transform 0.5s ease-in-out";
    counter++;
    carouselSlide.style.transform =
      "translateX(" + -slideWidth * counter + "px)";
  });

  prevBtn.addEventListener("click", () => {
    if (counter <= 0) return;
    carouselSlide.style.transition = "transform 0.5s ease-in-out";
    counter--;
    carouselSlide.style.transform =
      "translateX(" + -slideWidth * counter + "px)";
  });

  carouselSlide.addEventListener("transitionend", () => {
    if (slides[counter].id === "last-clone") {
      carouselSlide.style.transition = "none";
      counter = slides.length - 2;
      carouselSlide.style.transform =
        "translateX(" + -slideWidth * counter + "px)";
    }
    if (slides[counter].id === "first-clone") {
      carouselSlide.style.transition = "none";
      counter = slides.length - counter;
      carouselSlide.style.transform =
        "translateX(" + -slideWidth * counter + "px)";
    }
  });
});
