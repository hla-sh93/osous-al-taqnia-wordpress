/**
 * Scrolling list: one item is active at a time and the heading cell stays pinned
 * until the last item. Runs on every page; does nothing where the list is missing.
 */
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".list-item");
  const headingCell = document.querySelector(".list-scroll .grid-2 > .cell:first-child");
  const lastItem = items[items.length - 1];
  if (!headingCell || !lastItem) {
    return;
  }

  // One item active at a time.
  items.forEach((item) => {
    ScrollTrigger.create({
      trigger: item,
      start: "top center",
      end: "bottom center",
      toggleClass: {
        targets: item,
        className: "active",
      },
    });
  });

  // Pin the left cell until the last item ends.
  ScrollTrigger.matchMedia({
    "(min-width: 769px)": function () {
      ScrollTrigger.create({
        trigger: headingCell,
        start: "top center",
        endTrigger: lastItem,
        end: "bottom center",
        pin: true,
        pinSpacing: false,
        anticipatePin: 1,
      });
    },
  });

  window.addEventListener("resize", () => {
    ScrollTrigger.refresh();
  });
});
