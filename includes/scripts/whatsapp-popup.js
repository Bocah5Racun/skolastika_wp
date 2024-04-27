const question = document.getElementById("question");
const questionClose = document.getElementById("question-close");
const hero = document.getElementById("hero");

questionClose.addEventListener("click", () => {
  question.remove();
});

document.addEventListener("scroll", () => {
  const fromBottom =
    document.body.scrollHeight - window.innerHeight - window.scrollY;
  const fromTop = hero.getBoundingClientRect().top;

  question.style.opacity = fromBottom < 50 || fromTop > 0 ? 0 : 100;
});
