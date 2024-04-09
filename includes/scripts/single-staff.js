const accordions = document.querySelectorAll(".accordion-toggle");

accordions.forEach((e) => {
  e.addEventListener("click", () => {
    const forList = e.getAttribute("data-accordion-for-list");
    const forListNode = document.getElementById(forList);
    const listStatusNow = e.hasAttribute("data-accordion-open");

    if (listStatusNow) {
      e.removeAttribute("data-accordion-open");
      e.classList.remove("on");
    } else {
      e.setAttribute("data-accordion-open", "");
      e.classList.add("on");

      /* close all other accordions */
      accordions.forEach((el) => {
        if (el.getAttribute("data-accordion-for-list") != forList) {
          el.removeAttribute("data-accordion-open");
          el.classList.remove("on");
          document.getElementById(
            el.getAttribute("data-accordion-for-list")
          ).style.display = "none";
        }
      });
    }

    forListNode.style.display = e.hasAttribute("data-accordion-open")
      ? "flex"
      : "none";
    forListNode.parentElement.scrollIntoView();
  });
});
