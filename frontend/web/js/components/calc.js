import noUiSlider from 'nouislider';
import hcSticky from 'hc-sticky';

document.addEventListener("DOMContentLoaded", () => {
  if (document.querySelector('.product-gallary')) {
    const gallary = document.querySelector('.product-gallary');
    const mobWrapper = document.querySelector('.gallery-mob');
    const gallaryWrapper = document.querySelector('.product__col');

    const calc = document.querySelector('.sidebar-adapt');
    const calcMobWrapper = document.querySelector('.product__optional');
    const calcBackWrapper = document.querySelector('.sidebar__inner');
    const calcBages = document.querySelector('.product__bage-wrapper');

    let galleryBlock = mobWrapper.querySelector('.product-gallary');

    let Sticky = new hcSticky('.sidebar', {
      stickTo: '.product__col',
      top: 100,
      bottom: 100
    });

    window.addEventListener('resize', () => {
      if (screen.width < 768 && galleryBlock == null) {
        mobWrapper.appendChild(gallary);
        mobWrapper.appendChild(calcBages);
        calcMobWrapper.prepend(calc);
        Sticky.destroy();
      } else if (screen.width > 768 && galleryBlock == null) {
        gallaryWrapper.prepend(gallary);
        calcBackWrapper.appendChild(calc);
        calc.prepend(calcBages);
        Sticky.refresh();
      }

    })

    document.querySelectorAll('.calc-el__btn-control')
      .forEach(el => el.addEventListener('click', function (e) {
        if (!el.classList.contains('calc-el__btn-control--dis')) {
          let activElement = el.parentElement.closest('.calc-el');
          activElement.classList.toggle('calc-el--active');
        }
      }));


    const calcElements = document.querySelectorAll('.calc-el__list-item');
    calcElements.forEach(el => {
      el.addEventListener('click', () => {
        hideActive();
        el.classList.add('calc-el__list-item--active');
      })
    });

    function hideActive() {
      calcElements.forEach(el => {
        el.classList.remove('calc-el__list-item--active')
      })
    }
  }
});




