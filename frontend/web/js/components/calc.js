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
        if (!el.classList.contains('calc-el__btn-control--dis')) {
          let activElement = el.parentElement.closest('.calc-el');
          activElement.classList.toggle('calc-el--active');
        }
      }));

  }


  // TODO указать шаг, уточнить ценообразование
  if (sidebar != null) {

    const sliderH = document.getElementById('slider-h');

    const sliderW = document.getElementById('slider-w');

    const sliderG = document.getElementById('slider-g');

    if (sliderH != null && sliderW != null && sliderG != null) {
      
      noUiSlider.create(sliderH, {
        start: 20,
        connect: [true, false],
        range: {
          'min': 0,
          'max': 100
        }
      });
  
      noUiSlider.create(sliderW, {
        start: 40,
        connect: [true, false],
        range: {
          'min': 0,
          'max': 100
        }
      });
  
      noUiSlider.create(sliderG, {
        start: 60,
        connect: [true, false],
        range: {
          'min': 0,
          'max': 100
        }
      });
  
  
      sliderH.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_height = document.getElementById("constructor_height");
        let item_size_height_val = document.getElementById("constructor_height_val");
        item_size_height.innerHTML = values[handle] ;
        item_size_height_val.innerHTML = values[handle] ;
      });
      sliderW.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_width = document.getElementById("constructor_width");
        let item_size_width_val = document.getElementById("constructor_width_val");
        item_size_width.innerHTML = values[handle] ;
        item_size_width_val.innerHTML = values[handle] ;
      });
      sliderG.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_depth = document.getElementById("constructor_depth");
        let item_size_depth_val = document.getElementById("constructor_depth_val");
        item_size_depth.innerHTML = values[handle] ;
        item_size_depth_val.innerHTML = values[handle] ;
      });
    }

  }

});




