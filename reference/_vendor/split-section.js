console.log("GSAP scroll system initialized");

ScrollTrigger.matchMedia({
  // ✅ Desktop only (992px and up — adjust as needed)
  "(min-width: 992px)": function () {
    const cards = gsap.utils.toArray(".feature-card");
    const indicators = gsap.utils.toArray(".indicator");
    const imageItems = gsap.utils.toArray(".feature-image-item");

    // 🔧 Set initial state for all images
    // imageItems.forEach((img) => {
    //   gsap.set(img, { y: -50, opacity: 0 });
    // });

    // ✅ Pin the section while scrolling through cards
    ScrollTrigger.create({
      trigger: ".split-section",
      start: "center center",
      end: () => "+=" + cards.length * 500,
      pin: true,
      scrub: true,
      //   markers: true,
    });

    // ✅ One scroll trigger per card
    cards.forEach((card, i) => {
      ScrollTrigger.create({
        trigger: card,
        start: "top center",
        end: "bottom center",
        onEnter: () => showSlide(i),
        onEnterBack: () => showSlide(i),
        // markers: true,
      });
    });

    // ✅ Initialize the first slide on load
    showSlide(0);

    // ✅ Slide handler
    function showSlide(index) {
      // Move the wrapper vertically
      gsap.to(".feature-card-wrapper", {
        yPercent: -100 * index,
        duration: 0.4,
        // ease: "power2.inOut",
      });

      // Animate the image: fade + slide down
      //   imageItems.forEach((img, i) => {
      //     gsap.to(img, {
      //       y: i === index ? 0 : -50,
      //       opacity: i === index ? 1 : 0,
      //       duration: 0.6,
      //       ease: "power2.out",
      //     });
      //   });

      // Update indicators
      indicators.forEach((ind, i) => {
        ind.classList.toggle("active", i === index);
      });
    }
  },

  // ✅ Tablet & below — remove transforms, reset layout
  "(max-width: 991px)": function () {
    gsap.set(".feature-card-wrapper", { clearProps: "all" });
    gsap.set(".feature-image-item", { clearProps: "all" });

    document.querySelectorAll(".indicator").forEach((el) => {
      el.classList.remove("active");
    });

    document.querySelectorAll(".feature-card").forEach((card) => {
      card.classList.remove("active");
    });
  },
});
