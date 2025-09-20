const boxes = document.querySelectorAll('.box');
let index = 0;
function showNextBox() {
  const currentBox = boxes[index];
  currentBox.classList.add('animate');
  setTimeout(() => {
    currentBox.classList.remove('animate');
    index = (index + 1) % boxes.length;
    showNextBox();
  },21000);
}
window.onload = showNextBox;

