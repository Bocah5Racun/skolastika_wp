const burger = document.getElementById("burger-menu");
const mobileMenu = document.getElementById("mobile-menu");
const mobileMenuCloser = document.getElementById("mobile-menu-closer");

burger.addEventListener("click", () => {
  toggleBurger(true);
});

mobileMenuCloser.addEventListener("click", () => {
  toggleBurger(false);
});

function toggleBurger(burgerOn) {
  if (burgerOn) {
    gsap.to(mobileMenu, {
      ease: "circ.out",
      duration: 0.2,
      x: "100%",
    });
  } else {
    gsap.to(mobileMenu, {
      ease: "circ.in",
      duration: 0.2,
      x: "-100%",
    });
  }
}

// mobile menu animations
const menuItems = document.querySelectorAll(
  "#mobile-menu #menu-header-menu > li"
);

let subMenuTogglers = [];

menuItems.forEach((menuItem, index) => {
  const subMenuItems = menuItem.querySelector(".sub-menu");
  if (subMenuItems) {
    const expander = document.createElement("div");
    expander.classList.add("expander");
    expander.innerHTML = "+";
    menuItem.appendChild(expander);

    subMenuTogglers[index] = false;

    expander.addEventListener("click", () => {
      subMenuTogglers[index] = !subMenuTogglers[index];

      if (subMenuTogglers[index]) {
        gsap.to(expander, {
          ease: "circ.out",
          duration: 0.2,
          rotate: 135,
          translateY: 4,
        });
        gsap.to(subMenuItems, {
          duration: 0.2,
          maxHeight: "none",
          padding: "0.75rem",
        });
      } else {
        expander.innerHTML = "+";
        gsap.to(expander, {
          ease: "circ.out",
          duration: 0.2,
          rotate: 0,
          translateY: 0,
        });
        gsap.to(subMenuItems, {
          duration: 0.2,
          ease: "circ.out",
          maxHeight: 0,
          padding: 0,
        });
      }
    });
  }
});
