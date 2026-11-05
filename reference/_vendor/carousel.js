console.log("Swiper js initialized");
const swiper = new Swiper(".swiper-container", {
  slidesPerView: "auto", // Allows custom card widths
  // spaceBetween: 0,       // Use Webflow’s margin instead
  loop: true,            // Infinite scroll
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },

  on: {
    slideChange: function () {
      // Remove 'active' class from all '.card-4' elements
      document.querySelectorAll('.card-4').forEach(card => {
        card.classList.remove('active');
      });

      // Add 'active' class to the '.card-4' inside the active slide
      const activeSlide = this.slides[this.activeIndex];
      const activeCard = activeSlide.querySelector('.card-4');
      if (activeCard) {
        activeCard.classList.add('active');
      }
    },
  },
});