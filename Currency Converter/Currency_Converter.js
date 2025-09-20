const base_url = "https://api.exchangerate-api.com/v4/latest";
const dropdowns = document.querySelectorAll(".dropdown select");
const btn = document.querySelector("form button");
if (!btn) {
  console.error("Button element not found");
} else {
  btn.addEventListener("click", (evt) => {
    evt.preventDefault();
    updateexchangerate();
    updateFlag(fromCurr);
    updateFlag(toCurr);
  });
}
const swapIcon = document.querySelector(".fa-arrow-right-arrow-left");
const fromCurr = document.querySelector(".from select");
const toCurr = document.querySelector(".To select");
const msg = document.querySelector(".msg");
console.log("fromCurr:", fromCurr);
console.log("toCurr:", toCurr);
console.log("btn:", btn);
console.log("swapIcon:", swapIcon);
for (let select of dropdowns) {
  for (currcode in countrylist) {
    let newoption = document.createElement("option");
    newoption.innerText = currcode;
    newoption.value = currcode;
    if (select.name === "from" && currcode === "PKR") {
      newoption.selected = "selected";
    } else if (select.name === "To" && currcode === "USD") {
      newoption.selected = "selected";
    }
    select.append(newoption);
  }
  select.addEventListener("input", (evt) => {
    updateFlag(evt.target);
  });
}
const updateexchangerate = async () => {
  let amount = document.querySelector(".amount input");
  let amtval = amount.value;
  if (amtval === "" || amtval < 1) {
    amtval = 1;
    amount.value = "1";
  }
  const URL = `${base_url}/${fromCurr.value}`;
  try {
    let response = await fetch(URL);
    if (!response.ok) {
      msg.innerText = "Failed to fetch exchange rate.";
      return;
    }
    let data = await response.json();
    let rate = data.rates[toCurr.value];

    let finalamount = amtval * rate;
    msg.innerText = `${amtval} ${fromCurr.value} = ${finalamount.toFixed(2)} ${toCurr.value}`;
  } catch (error) {
    msg.innerText = "Error fetching exchange rate.";
    console.error(error);
  }
};
const updateFlag = (element) => {
  let currcode = element.value;
  let countrycode = countrylist[currcode];
  let newsrc = `https://flagcdn.com/32x24/${countrycode.toLowerCase()}.png`;
  let img = element.parentElement.querySelector("img");
  img.src = newsrc;
};
btn.addEventListener("click", (evt) => {
  evt.preventDefault();
  updateexchangerate();
  updateFlag(fromCurr);
  updateFlag(toCurr);
});
window.addEventListener("load", () => {
  updateexchangerate();
});
