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

    // TODO указать шаг, уточнить ценообразование
    const sliderH = document.getElementById('slider-h');
    const sliderW = document.getElementById('slider-w');
    const sliderG = document.getElementById('slider-g');

    if (sliderH != null && sliderW != null && sliderG != null) {

      let heightSlider =document.querySelector('#constructor_height_val') 
      let startHeight = heightSlider.getAttribute("data-slider-height");
      let minHeight = heightSlider.getAttribute("data-slider-min-height");
      let maxHeight = heightSlider.getAttribute("data-slider-max-height");
      let stepHeight = heightSlider.getAttribute("data-slider-step-height");
      noUiSlider.create(sliderH, {
        start: startHeight,
        connect: [true, false],
        range: {
          'min': Number(minHeight),
          'max': Number(maxHeight)
        }
      });

      let widthSlider = document.querySelector('#constructor_width_val');
      let startWidth = widthSlider.getAttribute("data-slider-width");
      let minWidth = widthSlider.getAttribute("data-slider-min-width");
      let maxWidth = widthSlider.getAttribute("data-slider-max-width");
      let stepWidth = widthSlider.getAttribute("data-slider-step-width");
      noUiSlider.create(sliderW, {
        start: startWidth,
        connect: [true, false],
        range: {
          'min': Number(minWidth),
          'max': Number(maxWidth)
        }
      });

      let depthSlider = document.querySelector('#constructor_depth_val');
      let startDepth = depthSlider.getAttribute("data-slider-depth");
      let minDepth = depthSlider.getAttribute("data-slider-min-depth");
      let maxDepth = depthSlider.getAttribute("data-slider-max-depth");
      let stepDepth = depthSlider.getAttribute("data-slider-step-depth");
      noUiSlider.create(sliderG, {
        start: startDepth,
        connect: [true, false],
        range: {
          'min': Number(minDepth),
          'max': Number(maxDepth),
        }
      });


      sliderH.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_height = document.getElementById("constructor_height");
        let item_size_height_val = document.getElementById("constructor_height_val");
        item_size_height.innerHTML = values[handle];
        item_size_height_val.innerHTML = values[handle];
      });
      sliderW.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_width = document.getElementById("constructor_width");
        let item_size_width_val = document.getElementById("constructor_width_val");
        item_size_width.innerHTML = values[handle];
        item_size_width_val.innerHTML = values[handle];
      });
      sliderG.noUiSlider.on('update', function (values, handle, unencoded) {
        let item_size_depth = document.getElementById("constructor_depth");
        let item_size_depth_val = document.getElementById("constructor_depth_val");
        item_size_depth.innerHTML = values[handle];
        item_size_depth_val.innerHTML = values[handle];
      });
    }

  }



});




