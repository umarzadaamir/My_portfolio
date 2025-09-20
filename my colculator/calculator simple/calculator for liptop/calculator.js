function squareRoot() {
    let display = document.getElementById("display");
    if (display.value !== "") {
        display.value = Math.sqrt(parseFloat(display.value));
    }
}let only_input = document.querySelector("#only_input");
// let only_input = $("#only_input");
let second_input_result = document.querySelector("#second_input_result");
let currentnmber = "";
let perviousnumber = "";
let operation = "";
let memory = 0; // memory storage

function appendtodisplay(number) {
  if (operation != "" && currentnmber == "" && perviousnumber == "") {
    if (operation != "√") {
      currentnmber += operation + number;
    } else {
      currentnmber += number;
    }
  } else {
    currentnmber += number;
  }
  only_input.value += number;
  second_input_result.value += number;
}

// New functions for additional buttons
function appendValue(val) {
  appendtodisplay(val);
}

function calculatePercent() {
  if (currentnmber !== "") {
    let value = parseFloat(currentnmber);
    if (!isNaN(value)) {
      currentnmber = (value / 100).toString();
      updatedisplay();
    }
  }
}

function calculateResult() {
  try {
    let result = eval(only_input.value);
    currentnmber = result.toString();
    updatedisplay();
  } catch (e) {
    currentnmber = "Error";
    updatedisplay();
  }
}

function squareRoot() {
  let display = document.getElementById("only_input");
  if (display.value !== "") {
    try {
      let value = parseFloat(display.value);
      if (!isNaN(value)) {
        let result = Math.sqrt(value);
        display.value = result;
        second_input_result.value = result;
      }
    } catch (e) {
      display.value = "Error";
      second_input_result.value = "Error";
    }
  }
}

// Event listeners for under_root_btn and mu_btn
document.addEventListener("DOMContentLoaded", () => {
  const underRootBtn = document.getElementById("under_root_btn");
  const muBtn = document.getElementById("mu_btn");

  if (underRootBtn) {
    underRootBtn.addEventListener("click", () => {
      appendValue("(");
    });
  }

  if (muBtn) {
    muBtn.addEventListener("click", () => {
      appendValue(")");
    });
  }
});

function restedisplay() {
  currentnmber = "";
  second_input_result.value = "";
  operation = "";
  updatedisplay();
}

function removegitit() {
  let digit = only_input.value;
  digit = second_input_result.value;
  if (digit.length > 0) {
    only_input.value = digit.slice(0, -1);
    second_input_result.value = digit.slice(0, -1);
  }
}

function setopration(op) {
  only_input.value += op;
  operation = op;
  second_input_result.value += op;
  if (currentnmber === "") return;
  if (perviousnumber !== "") {
    calculate();
  }
  perviousnumber = currentnmber;
  currentnmber = "";
}

function calculate() {
  let result = 0;
  let memory = 0;
  let prev = parseFloat(perviousnumber);
  let current = parseFloat(currentnmber);
  switch (operation) {
    case "+":
      result = prev + current;
      break;
    case "-":
      result = prev - current;
      break;
    case "*":
      result = prev * current;
      break;
    case "%":
      result = prev % current;
      break;
    case "/":
      result = current !== 0 ? prev / current : "error";
      break;
    case "√":
      if (!isNaN(prev)) {
        result = prev * Math.sqrt(current);
      } else {
        result = Math.sqrt(current);
      }
      if (isNaN(result)) {
        result = "Error";
      }
      break;
    case "MU":
      if (isNaN(prev) || isNaN(current)) result = prev + (prev * current) / 100;
      else {
        result = "error";
      }
      break;
    case "M-":
      memory -= current;
      current.value = "";
      alert(`memory  subtracted! current memory : ${memory}`);
      break;
    case "M+":
      if (!isNaN(current)) {
        memory += current;
        only_input.innerHTML = `M1 ${current}`;
      } else {
        alert("please inter a valid number");
      }
      break;
    case "MR":
      prev.value = memory;
      alert(`memory recalled! current value : ${memory}`);
      break;
    case "MC":
      memory = 0;
      prev.value = "";
      alert("memory cleard!");
      break;
    case "togglesign":
      current = -current;
      current = current.toFixed(4);
      break;

    default:
      return;
  }
  currentnmber = result.toString();
  operation = "";
  perviousnumber = "";
  updatedisplay();
}

function updatedisplay() {
  only_input.value = currentnmber;
  second_input_result.value = currentnmber;
}

function change_size(v) {
  let online_calculator_div = document.querySelector("#online_calculator_div");
  let slectedsize = v;
  let basesize = 100;
  let scale = 1;
  if (slectedsize.indexOf("+") !== -1) {
    let percentage = parseFloat(slectedsize.split("+")[1]);
    scale = (basesize + percentage) / 100;
  } else if (slectedsize.indexOf("-") !== -1) {
    let percentage = parseFloat(slectedsize.split("-")[1]);
    scale = (basesize - percentage) / 100;
  } else {
    scale = basesize / 100;
  }
  online_calculator_div.style.transform = `scale(${scale})`;
  // Move calculator down proportionally to scale
  let baseMarginTop = 40; // original margin-top in px
  let newMarginTop = baseMarginTop * scale;
  online_calculator_div.style.marginTop = `${newMarginTop}px`;
}

// Add event listeners for size selectors
document.addEventListener("DOMContentLoaded", () => {
  const selectOne = document.getElementById("select_one");
  const selectTwo = document.getElementById("select_two");

  if (selectOne) {
    selectOne.addEventListener("change", (e) => {
      change_size(e.target.value);
    });
  }

  if (selectTwo) {
    selectTwo.addEventListener("change", (e) => {
      // You can add functionality for select_two if needed
      console.log("Mode changed to:", e.target.value);
    });
  }
});

// Fix mode_button usage
const mode_button = document.getElementById("mode_button");
if (mode_button) {
  let currentmode = "light mode";
  mode_button.addEventListener("click", () => {
    if (currentmode === "light mode") {
      currentmode = "dark mode";
      document.querySelector("html").style.backgroundColor = "black";
    } else {
      currentmode = "light mode";
      document.querySelector("html").style.backgroundColor = "white";
    }
  });
}
