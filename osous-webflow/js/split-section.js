/**
 * Split section: the cards scroll inside a pinned section and the indicators follow.
 * Pages pass their slide timing in window.osousSplitSection ({ duration, ease }).
 */
(function () {
  const options = Object.assign({ duration: 0.4 }, window.osousSplitSection || {});

  ScrollTrigger.matchMedia({
    // Desktop only (992px and up).
    "(min-width: 992px)": function () {
      const cards = gsap.utils.toArray(".feature-card");
      const indicators = gsap.utils.toArray(".indicator");

      // Pin the section while scrolling through the cards.
      ScrollTrigger.create({
        trigger: ".split-section",
        start: "center center",
        end: () => "+=" + cards.length * 500,
        pin: true,
        scrub: true,
      });

      // One scroll trigger per card.
      cards.forEach((card, i) => {
        ScrollTrigger.create({
          trigger: card,
          start: "top center",
          end: "bottom center",
          onEnter: () => showSlide(i),
          onEnterBack: () => showSlide(i),
        });
      });

      showSlide(0);

      function showSlide(index) {
        const tween = { yPercent: -100 * index, duration: options.duration };
        if (options.ease) {
          tween.ease = options.ease;
        }
        gsap.to(".feature-card-wrapper", tween);

        indicators.forEach((ind, i) => {
          ind.classList.toggle("active", i === index);
        });
      }
    },

    // Tablet and below: remove transforms, reset the layout.
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
})();
