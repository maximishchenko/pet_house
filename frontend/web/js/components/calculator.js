import HcSticky from 'hc-sticky';
import noUiSlider from 'nouislider';

if (document.querySelector('.product')) {

    const stickybar = new HcSticky('.sidebar', {
        stickTo: '.product__col',
        top: 100,
        bottom: 100,
        responsive: {
            768: {
                disable: true
            }
        }
    });

    const productContainer = document.querySelector('.product');
    const modAdaptContainer = document.querySelector('.mob-adapt-calc');
    const sideBar = document.querySelector('.product__col-calc');

    function sideBarController() {
        if (screen.width < 768 && !modAdaptContainer.querySelector('.product__col-calc')) {
            modAdaptContainer.append(sideBar);
        } else if (screen.width > 768 && !productContainer.children[1]) {
            productContainer.append(sideBar)
            stickybar.refresh();
        }
    }

    sideBarController();

    window.addEventListener('resize', sideBarController);

    // Показать/скрыт
    document.querySelectorAll('.calc-el__btn-control').forEach(el => {
        el.addEventListener('click', () => {
            el.parentNode.classList.toggle('calc-el--active');
        });
    });


    class ProductCalculator {
        #totalPrice;

        constructor(totalPrice, totalOldPrice) {
            this.totalPrice = document.querySelector(totalPrice);
            this.totalSalePrice = document.querySelector(totalOldPrice);
            this.#getTotalPrice();
        }


        #getTotalPrice() {
            this.#totalPrice = Number(this.totalPrice.textContent.split(' ').join(''));
        }

        calcProduct(type, val1, val2) {

            if (type == 'btn-calc') {

                let price = this.#totalPrice - Number(val2) + Number(val1);
                this.#totalPrice = price;
                this.#setCalcPrice(price, this.#calcSalePrice(price));

            } else if (type == 'slider-calc') {

                let price = this.#totalPrice + (Number(val1) * Number(val2));
                this.#totalPrice = price;
                this.#setCalcPrice(price, this.#calcSalePrice(price));

            } else {
                throw new Error('Incorrect Param Type');
            }

        }

        #setCalcPrice(newPrice, newSalePrice) {

            this.totalPrice.textContent = newPrice.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            this.totalSalePrice.textContent = newSalePrice.toLocaleString('ru-RU', { minimumFractionDigits: 0 });

        }

        #calcSalePrice(price) {
            return Math.trunc(price + ((price * 10) / 100));
        }

    }

    const productCalculator = new ProductCalculator('#constructor_price', '#constructor_price_old');


    // Вобор элемента калькулятора
    const calcSelects = document.querySelectorAll('.calc-el__list-item');

    calcSelects.forEach(el => {

        el.addEventListener('click', () => {

            let selectSection = el.parentNode;
            let activeSelect = selectSection.querySelector('.calc-el__list-item--active');
            let activeSelectPrice = activeSelect.getAttribute('data-price');

            activeSelect.classList.remove('calc-el__list-item--active');
            el.classList.add('calc-el__list-item--active');


            if (selectSection.classList.contains('calc-el__list--color')) {

                let elPrice = el.getAttribute('data-price');
                const colorImg = document.querySelector('#calc-color-img');
                const colorTitle = document.querySelector('#calc-color-title');
                colorImg.style.backgroundImage = el.style.backgroundImage;
                colorTitle.textContent = el.getAttribute('data-color-name');

                productCalculator.calcProduct('btn-calc', elPrice, activeSelectPrice);

            } else if (selectSection.classList.contains('calc-el__list--size')) {

                let elPrice = el.getAttribute('data-price');
                const constructorHeight = document.querySelector('#constructor_height');
                const constructorWidth = document.querySelector('#constructor_width');
                const constructorDepth = document.querySelector('#constructor_depth');
                constructorHeight.textContent = el.getAttribute('data-size-height');
                constructorWidth.textContent = el.getAttribute('data-size-width');
                constructorDepth.textContent = el.getAttribute('data-size-depth');

                productCalculator.calcProduct('btn-calc', elPrice, activeSelectPrice);


            } else if (selectSection.classList.contains('calc-el__list--walls')) {

                let elPrice = el.getAttribute('data-price');
                const wallsTitle = document.querySelector('#calc-walls-title');
                wallsTitle.textContent = el.getAttribute('data-wall-name');

                productCalculator.calcProduct('btn-calc', elPrice, activeSelectPrice);

            }

        });

    });

    const sliderH = document.getElementById('slider-h');
    const sliderW = document.getElementById('slider-w');
    const sliderD = document.getElementById('slider-g');

    if (sliderH != null && sliderW != null && sliderD != null) {

        const cageParams = document.querySelector('#dogCageSizeParams');
        const heightPrice = cageParams.getAttribute('data-height-price');
        const widthPrice = cageParams.getAttribute('data-width-price');
        const depthPrice = cageParams.getAttribute('data-depth-price');

        let heightSlider = document.querySelector('#constructor_height_val'),
            startHeight = heightSlider.getAttribute("data-slider-height"),
            minHeight = heightSlider.getAttribute("data-slider-min-height"),
            maxHeight = heightSlider.getAttribute("data-slider-max-height"),
            stepHeight = heightSlider.getAttribute("data-slider-step-height");

        noUiSlider.create(sliderH, {
            start: startHeight,
            connect: [true, false],
            step: Number(stepHeight),
            range: {
                'min': Number(minHeight) - 5,
                'max': Number(maxHeight) + 5
            },
            padding: [5, 5],
        });

        sliderH.noUiSlider.on('slide', function (values, handle, unencoded) {
            let item_size_height = document.getElementById("constructor_height");
            let item_size_height_val = document.getElementById("constructor_height_val");
            item_size_height.innerHTML = Math.trunc(values[handle]);
            item_size_height_val.innerHTML = `${Math.trunc(values[handle])} см`;

            let hendleVal = Math.trunc(sliderH.noUiSlider.get());

            if (startHeight > hendleVal) {
                productCalculator.calcProduct('slider-calc', -1, heightPrice);
                startHeight = hendleVal;
            } else {
                startHeight = hendleVal;
                productCalculator.calcProduct('slider-calc', 1, heightPrice);
            }
        });

        let widthSlider = document.querySelector('#constructor_width_val'),
            startWidth = widthSlider.getAttribute("data-slider-width"),
            minWidth = widthSlider.getAttribute("data-slider-min-width"),
            maxWidth = widthSlider.getAttribute("data-slider-max-width"),
            stepWidth = widthSlider.getAttribute("data-slider-step-width");

        noUiSlider.create(sliderW, {
            start: startWidth,
            connect: [true, false],
            step: Number(stepWidth),
            range: {
                'min': Number(minWidth) - 10,
                'max': Number(maxWidth) + 10
            },
            padding: [10, 10],
        });

        sliderW.noUiSlider.on('slide', function (values, handle, unencoded) {
            let item_size_width = document.getElementById("constructor_width");
            let item_size_width_val = document.getElementById("constructor_width_val");
            item_size_width.innerHTML = Math.trunc(values[handle]);
            item_size_width_val.innerHTML = `${Math.trunc(values[handle])} см`;

            let hendleVal = Math.trunc(sliderW.noUiSlider.get());

            if (startWidth > hendleVal) {
                productCalculator.calcProduct('slider-calc', -1, widthPrice);
                startWidth = hendleVal;
            } else {
                productCalculator.calcProduct('slider-calc', 1, widthPrice);
                startWidth = hendleVal
            }
        });

        let depthSlider = document.querySelector('#constructor_depth_val'),
            startDepth = depthSlider.getAttribute("data-slider-depth"),
            minDepth = depthSlider.getAttribute("data-slider-min-depth"),
            maxDepth = depthSlider.getAttribute("data-slider-max-depth"),
            stepDepth = depthSlider.getAttribute("data-slider-step-depth");

        noUiSlider.create(sliderD, {
            start: startDepth,
            connect: [true, false],
            step: Number(stepDepth),
            range: {
                'min': Number(minDepth) - 5,
                'max': Number(maxDepth) + 5,
            },
            padding: [5, 5],
        });

        sliderD.noUiSlider.on('slide', function (values, handle, unencoded) {
            let item_size_depth = document.getElementById("constructor_depth");
            let item_size_depth_val = document.getElementById("constructor_depth_val");
            item_size_depth.innerHTML = Math.trunc(values[handle]);
            item_size_depth_val.innerHTML = `${Math.trunc(values[handle])} см`;

            let hendleVal = Math.trunc(sliderD.noUiSlider.get());

            if (startDepth > hendleVal) {
                productCalculator.calcProduct('slider-calc', -1, depthPrice);
                startDepth = hendleVal
            } else {
                productCalculator.calcProduct('slider-calc', 1, depthPrice);
                startDepth = hendleVal
            }
        });

    }


    /* window.addEventListener('resize', () => {
        if (screen.width < 768 && galleryBlock == null) {
            mobWrapper.appendChild(gallary);
            mobWrapper.appendChild(calcBages);
            calcMobWrapper.prepend(calc);
            stickybar.destroy();
        } else if (screen.width > 768 && galleryBlock == null) {
            gallaryWrapper.prepend(gallary);
            calcBackWrapper.appendChild(calc);
            calc.prepend(calcBages);
            stickybar.update();
        }
    
    }) */
}