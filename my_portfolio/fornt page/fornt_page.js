// Typing effect
var typed = new Typed("#typed", {
  strings: ["Backend Developer", "Problem Solver", "Fast Learner"],
  typeSpeed: 70,
  backSpeed: 40,
  loop: true
});

// Dark/Light mode toggle
document.getElementById("theme-toggle").addEventListener("click", function () {
  document.body.classList.toggle("light-mode");
  this.textContent = document.body.classList.contains("light-mode") ? "☀️" : "🌙";
});
