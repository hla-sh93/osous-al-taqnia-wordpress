/**
 * Scrolling list with pictures (e-commerce, mobile app and website design pages):
 * the active item fades in, its picture pops up, and the heading cell stays pinned.
 */
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".list_item_2");
  const headingCell = document.querySelector(".list-scroll .grid-2 > .cell:first-child");
  const lastItem = items[items.length - 1];

  ScrollTrigger.matchMedia({
    "(min-width: 825px)": function () {
      items.forEach((item) => {
        const img = item.querySelector(".list_item_img");

        // Items start at 40% opacity.
        gsap.set(item, { opacity: 0.4 });

        ScrollTrigger.create({
          trigger: item,
          start: "top center",
          end: "bottom center",
          onToggle: (self) => {
            item.classList.toggle("active", self.isActive);
            gsap.to(item, {
              opacity: self.isActive ? 1 : 0.4,
              duration: 0.4,
              ease: "power2.out",
              overwrite: "auto",
            });
          },
        });

        // The picture pops up with a slight rotation.
        if (img) {
          gsap.fromTo(
            img,
            { opacity: 0, scale: 0.8, y: 20, rotation: -5 },
            {
              opacity: 1,
              scale: 1,
              y: 0,
              rotation: 0,
              duration: 0.5,
              ease: "back.out(1.5)",
              scrollTrigger: {
                trigger: item,
                start: "top center",
                end: "bottom center",
                toggleActions: "play reverse play reverse",
              },
            }
          );
        }
      });

      // Pin the left cell until the last item ends.
      if (headingCell && lastItem) {
        ScrollTrigger.create({
          trigger: headingCell,
          start: "top center",
          endTrigger: lastItem,
          end: "bottom center",
          pin: true,
          pinSpacing: false,
          anticipatePin: 1,
        });
      }
    },
  });

  window.addEventListener("resize", () => {
    ScrollTrigger.refresh();
  });
});
