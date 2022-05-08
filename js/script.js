const transferTitle = document.querySelector('[data-option="transferTitle"]');
const Title = document.querySelector('[data-option="Title"]');

const priceOne = document.querySelector('[data-option="priceOne"]');
const priceTwo = document.querySelector('[data-option="priceTwo"]');
const NumberOne = document.querySelector('[data-option="NumberOne"]');
const NumberOneID = document.querySelector('[data-option="NumberOneID"]');
const NumberTwo = document.querySelector('[data-option="NumberTwo"]');
const NumberTwoID = document.querySelector('[data-option="NumberTwoID"]');
const iconChange = document.querySelector('[data-option="iconChangeAccount"]');

if (iconChange) {
  let tmp = '';

  const changeValueAccount = () => {
    tmp = priceOne.value;
    priceOne.value = priceTwo.value;
    priceTwo.value = tmp;

    tmp = NumberOne.value;
    NumberOne.value = NumberTwo.value;
    NumberTwo.value = tmp;

    tmp = NumberOneID.value;
    NumberOneID.value = NumberTwoID.value;
    NumberTwoID.value = tmp;
  };

  iconChange.addEventListener('click', function () {
    changeValueAccount();
  });
}

if (Title) {
  transferTitle.addEventListener('input', function () {
    Title.textContent = event.target.value.length;
  });
}
