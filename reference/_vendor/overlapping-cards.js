console.log("GSAP overlapping cards effect initialized");

ScrollTrigger.matchMedia({
  "(min-width: 992px)": function () {
    const cards = gsap.utils.toArray(".card-overlapping-item");

    // Step 1: Offset visually (just for initial look)
    cards.forEach((card, i) => {
      gsap.set(card, {
        x: i * 40,
        y: i * 15,
        opacity: 1 - i * 0.1,
        zIndex: cards.length - i,
      });
    });

    // Step 2: Pin the section
    ScrollTrigger.create({
      trigger: ".section.overlapping-cards",
      start: "top top",
      end: () => "+=" + (cards.length - 1) * 300,
      pin: true,
      scrub: true,
      // markers: true,
      onUpdate: (self) => {
        const progress = self.progress;
        const totalCards = cards.length;
        const currentIndex = Math.floor(progress * (totalCards - 1));
        updateCards(currentIndex);
      },
    });

    // Step 3: Just fade cards and toggle class — no movement

    function updateCards(activeIndex) {
      cards.forEach((card, i) => {
        const innerCard = card.querySelector(".card-4");
        const card_content = card?.querySelector(".content");

        if (i === activeIndex) {
          innerCard.classList.add("active2");
          gsap.to(card_content, { opacity: 1 });
        } else {
          innerCard.classList.remove("active2");
          gsap.to(card_content, { opacity: 0 });
        }

        if (i < activeIndex) {
          gsap.to(card, {
            opacity: 0,
            duration: 0.4,
            ease: "power2.out",
          });
        } else {
          gsap.to(card, {
            opacity: 1,
            duration: 0.4,
            ease: "power2.out",
          });
        }
      });
    }
    updateCards(0);
  },
});
