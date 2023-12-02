// Показать/скрыть
document.querySelectorAll('.calc-el__btn-control').forEach(el => {
      el.addEventListener('click', () => {
          el.parentNode.classList.toggle('calc-el--active');
      });
  });


// Вобор элемента калькулятора
const calcSelects = document.querySelectorAll('.calc-el__list-item');

function unselectAllCalcSelects() {
    calcSelects.forEach(el => {
        el.classList.remove('calc-el__list-item--active');
    });
}

calcSelects.forEach(el => {
    el.addEventListener('click', () => {

        unselectAllCalcSelects();
        el.classList.add('calc-el__list-item--active');

        if (el.parentNode.classList.contains('calc-el__list--color')) {
            const colorImg = document.querySelector('#calc-color-img');
            const colorTitle = document.querySelector('#calc-color-title');
            colorImg.style.backgroundImage = el.style.backgroundImage;
            colorTitle.textContent = el.getAttribute('data-color-name');
        }

        if (el.parentNode.classList.contains('calc-el__list--size')) {
            const constructorHeight = document.querySelector('#constructor_height');
            const constructorWidth = document.querySelector('#constructor_width');
            const constructorDepth = document.querySelector('#constructor_depth');
            constructorHeight.textContent = el.getAttribute('data-size-height');
            constructorWidth.textContent = el.getAttribute('data-size-width');
            constructorDepth.textContent = el.getAttribute('data-size-depth');
        }

        if (el.parentNode.classList.contains('calc-el__list--walls')) {
            const wallsTitle = document.querySelector('#calc-walls-title');
            wallsTitle.textContent = el.getAttribute('data-wall-name');
        }

    });
});