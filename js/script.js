const transferTitle = document.querySelector('[data-option="transferTitle"]');
const Title = document.querySelector('[data-option="Title"]');
const nameBank = document.querySelector('[data-option="nameBank"]');
const numberBank = document.querySelector('[data-option="numberBank"]');
const errorNumber = document.querySelector('[data-option="errorNumber"]');
const errorNumberTitle = document.querySelector(
  '[data-option="errorNumberTitle"]'
);

let isError = false;
let tooLong = false;

if (Title) {
  transferTitle.addEventListener('input', function () {
    Title.textContent = event.target.value.length;
    if (Title.textContent === '0') {
      transferTitle.value = 'Przelew';
      Title.textContent = '7';
    }

    if (event.target.value.length > 140 && !tooLong) {
      tooLong = true;
      errorNumberTitle.style.visibility = 'visible';
    }
    if (event.target.value.length <= 140 && tooLong) {
      tooLong = false;
      errorNumberTitle.style.visibility = 'hidden';
    }
  });

  const NumberAccountBank = Number => {
    if (Number.length === 6) {
      if (Number.slice(2, 6) !== nameBank.value) {
        isError = true;
        errorNumber.style.visibility = 'visible';
      } else if (isError) {
        isError = false;
        errorNumber.style.visibility = 'hidden';
      }
    }
  };

  numberBank.addEventListener('input', function () {
    NumberAccountBank(event.target.value);
  });

  nameBank.addEventListener('change', function () {
    NumberAccountBank(numberBank.value);
  });
}
