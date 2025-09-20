const display = document.getElementById('display');
const buttons = document.getElementById('buttons-container');

let fullExpression = '';

function updateDisplay() {
  display.value = fullExpression || '0';
}

function appendNumber(num) {
  if (num === '.' && fullExpression.endsWith('.')) return;
  fullExpression += num;
  updateDisplay();
}

function isOperator(char) {
  return ['+', '-', '*', '/'].includes(char);
}

function appendOperator(op) {
  if (fullExpression === '') return;

  // Prevent multiple consecutive operators
  if (isOperator(fullExpression.slice(-1))) {
    fullExpression = fullExpression.slice(0, -1) + op;
  } else {
    fullExpression += op;
  }
  updateDisplay();
}

function calculate() {
  try {
    // Evaluate the full expression safely
    let result = Function('"use strict";return (' + fullExpression + ')')();
    fullExpression = result.toString();
  } catch (e) {
    fullExpression = 'Error';
  }
  updateDisplay();
}

function clear() {
  fullExpression = '';
  updateDisplay();
}

function deleteLast() {
  if (fullExpression.length > 0) {
    fullExpression = fullExpression.slice(0, -1);
  }
  updateDisplay();
}

buttons.addEventListener('click', (e) => {
  const target = e.target;
  if (!target.classList.contains('btn')) return;

  if (target.classList.contains('number')) {
    appendNumber(target.dataset.num);
  } else if (target.classList.contains('operator')) {
    appendOperator(target.dataset.op);
  } else if (target.id === 'clear') {
    clear();
  } else if (target.id === 'delete') {
    deleteLast();
  } else if (target.id === 'equals') {
    calculate();
  }
});
