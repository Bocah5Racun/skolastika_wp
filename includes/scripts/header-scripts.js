const burger = document.getElementById("burger-menu");
const mobileMenu = document.getElementById("mobile-menu");
const mobileMenuCloser = document.getElementById("mobile-menu-closer");

burger.addEventListener("click", () => {
  toggleBurger(true);
});

mobileMenuCloser.addEventListener("click", () => {
  console.log("Clicked Closer!");
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
