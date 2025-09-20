const input = document.querySelector("#input");
let resulteplace = document.querySelector(".result_place");
const check_btn = document.querySelector("#check_button");
const button_continor = document.querySelector(".btn_continor");
let reset_btn = document.querySelector("#reset_button");
let modebutton = document.querySelector("#mode");
const btn1 = document.querySelector("#button1");
const btn2 = document.querySelector("#button2");
const btn3 = document.querySelector("#button3");
const btn4 = document.querySelector("#button4");
const btn5 = document.querySelector("#button5");
const btn6 = document.querySelector("#button6");
const btn7 = document.querySelector("#button7");
const btn8 = document.querySelector("#button8");
const btn9 = document.querySelector("#button9");
const btn0 = document.querySelector("#button0");
btn1.addEventListener("click", () => {
  {
    input.value += btn1.innerHTML;
  }
});
btn2.addEventListener("click", () => {
  {
    input.value += btn2.innerHTML;
  }
});
btn3.addEventListener("click", () => {
  {
    input.value += btn3.innerHTML;
  }
});
btn4.addEventListener("click", () => {
  {
    input.value += btn4.innerHTML;
  }
});
btn5.addEventListener("click", () => {
  {
    input.value += btn5.innerHTML;
  }
});
btn6.addEventListener("click", () => {
  {
    input.value += btn6.innerHTML;
  }
});
btn7.addEventListener("click", () => {
  {
    input.value += btn7.innerHTML;
  }
});
btn8.addEventListener("click", () => {
  {
    input.value += btn8.innerHTML;
  }
});
btn9.addEventListener("click", () => {
  {
    input.value += btn9.innerHTML;
  }
});
btn0.addEventListener("click", () => {
  {
    input.value += btn0.innerHTML;
  }
});
check_btn.addEventListener("click", () => {
  let num = parseInt(input.value);
  let grade;
  if (num < 60) {
    grade = "grade = F";
  } else if (num < 70) {
    grade = "grade = D";
  } else if (num < 80) {
    grade = "grade = C";
  } else if (num < 90) {
    grade = "grade = B";
  } else if (num <= 100) {
    grade = "grade = A";
  } else {
    grade = "wrong number";
  }
  resulteplace.innerHTML = grade;
  // btn1.ariaDisabled = true;
});
reset_btn.addEventListener("click", () => {
  input.value = "";
  reset_btn.innerHTML = "CLEAR";
  resulteplace.innerHTML = "RESULT  PLACE";
});
let currentmode = "light mode";
modebutton.addEventListener("click", () => {
  if (currentmode === "light mode") {
    currentmode = "dark mode";
    document.querySelector("body").style.backgroundColor = "black";
  } else {
    currentmode = "light mode";
    document.querySelector("body").style.backgroundColor = "white";
  }
});
