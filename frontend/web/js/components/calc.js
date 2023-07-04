import FloatSidebar from 'float-sidebar';
import noUiSlider from 'nouislider';

document.addEventListener("DOMContentLoaded", () => {

  const sidebar = document.querySelector('.sidebar');
  const relative = document.querySelector('.product__col');

  if (relative != null) {
    const floatSidebar = FloatSidebar({
      sidebar,
      relative,
      topSpacing: 140,
      bottomSpacing: 140
    });

    const gallary = document.querySelector('.product-gallary');
    const mobWrapper = document.querySelector('.gallery-mob');
    const gallaryWrapper = document.querySelector('.product__col');

    const calc = document.querySelector('.sidebar-adapt');
    const calcMobWrapper = document.querySelector('.product__optional');
    const calcBackWrapper = document.querySelector('.sidebar__inner');
    const calcBages = document.querySelector('.product__bage-wrapper');

    function adapt() {

      let galleryBlock = mobWrapper.querySelector('.product-gallary');

      if (screen.width < 768 && galleryBlock == null) {

        mobWrapper.appendChild(gallary);
        mobWrapper.appendChild(calcBages);
        calcMobWrapper.prepend(calc);

      } else if (screen.width > 768 && galleryBlock) {

        gallaryWrapper.prepend(gallary);
        calcBackWrapper.appendChild(calc);
        calc.prepend(calcBages);
        floatSidebar.forceUpdate();

      }
    }

    addEventListener("resize", () => {
      adapt();
    });

    adapt();

    document.querySelectorAll('.calc-el__btn-control')
      .forEach(el => el.addEventListener('click', function (e) {
        let activElement = el.parentElement.closest('.calc-el');
        activElement.classList.toggle('calc-el--active');
      }));

  }

  const sliderH = document.getElementById('slider-h');

  noUiSlider.create(sliderH, {
    start: 20,
    connect: [true, false],
    range: {
      'min': 0,
      'max': 100
    }
  });

  const sliderW = document.getElementById('slider-w');

  noUiSlider.create(sliderW, {
    start: 40,
    connect: [true, false],
    range: {
      'min': 0,
      'max': 100
    }
  });

  const sliderG = document.getElementById('slider-g');

  noUiSlider.create(sliderG, {
    start: 60,
    connect: [true, false],
    range: {
      'min': 0,
      'max': 100
    }
  });
});




