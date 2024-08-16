const question = document.getElementById("question");
const questionClose = document.getElementById("question-close");
const hero = document.getElementById("hero");

const questionTl = gsap
  .timeline({
    paused: true,
  })
  .to(question, {
    duration: 0.2,
    ease: "circ.inOut",
    repeat: 1,
    y: "-25%",
    yoyo: true,
  })
  .to(question, {
    duration: 0.5,
    right: "-100%",
  });

let disableQuestion = false;
let questionToggle = false;

const scrollListener = document.addEventListener("scroll", () => {
  const fromBottom =
    document.body.scrollHeight - window.innerHeight - window.scrollY;
  const fromTop = hero.getBoundingClientRect().top;

  const prevToggle = questionToggle;
  questionToggle = fromBottom < 50 || fromTop > 0 ? false : true;

  console.log(`${fromBottom}`);

  if (prevToggle != questionToggle) {
    if (questionToggle) {
      questionTl.reverse(0);
    } else {
      questionTl.play();
    }
  }
});

questionClose.addEventListener("click", () => {
  closeQuestion = true;
  questionTl.play();
  question.removeEventListener(scrollListener);
});
