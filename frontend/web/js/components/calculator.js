import HcSticky from 'hc-sticky';
import noUiSlider from 'nouislider';

if (document.querySelector('.product') && document.querySelector('.calc-el__btn-control')) {

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
        if (!el.classList.contains('calc-el__btn-control--dis')) {
            el.addEventListener('click', () => {
                el.parentNode.classList.toggle('calc-el--active');
            });
        }
    });


    class ProductCalculator {
        #totalPrice;
        #sliderHeigth;
        #sliderWidth;
        #sliderDepth;
        #sliderHeigthStep;
        #sliderWidthStep;
        #sliderDepthStep;
        des = 0;

        constructor(totalPrice, totalOldPrice, sliderHeightSelector, sliderWithSelector, sliderDepthSelector) {
            this.totalPrice = document.querySelector(totalPrice);
            this.totalSalePrice = document.querySelector(totalOldPrice);
            this.des = this.totalSalePrice?.getAttribute('data-product-discount');

            this.sliderHeigthSelector = document.querySelector(sliderHeightSelector);
            this.sliderWidthSelector = document.querySelector(sliderWithSelector);
            this.sliderDepthSelector = document.querySelector(sliderDepthSelector);

            this.#sliderHeigth = this.sliderHeigthSelector?.getAttribute('data-slider-height');
            this.#sliderWidth = this.sliderWidthSelector?.getAttribute('data-slider-width');
            this.#sliderDepth = this.sliderDepthSelector?.getAttribute('data-slider-depth');

            this.#sliderHeigthStep = this.sliderHeigthSelector?.getAttribute('data-slider-step-height');
            this.#sliderWidthStep = this.sliderWidthSelector?.getAttribute('data-slider-step-width');
            this.#sliderDepthStep = this.sliderDepthSelector?.getAttribute('data-slider-step-depth');

            this.#getTotalPrice();
        }


        #getTotalPrice() {
            this.#totalPrice = Number(this.totalPrice.textContent.split(' ').join(''));
        }

        calcProduct(type, val1, val2) {

            if (type == 'btn-calc') {
                let price = Math.round(this.#totalPrice - Number(val2) + Number(val1));
                this.#totalPrice = price;
                this.#setCalcPrice(price, this.#calcSalePrice(price));
            }
            else {
                throw new Error('Incorrect Param Type');
            }

        }

        #setCalcPrice(newPrice, newSalePrice) {

            this.totalPrice.textContent = newPrice.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            this.totalSalePrice.textContent = newSalePrice.toLocaleString('ru-RU', { minimumFractionDigits: 0 });

        }

        #calcSalePrice(price) {
            let old_price = Math.trunc(price + ((price * this.des) / 100));
            return Math.ceil(old_price / 100) * 100;

        }

        sliderCalcHeight(heigthVal, heightPrice, operator) {
            let steps = this.#sliderCalcSteps(heigthVal, this.#sliderHeigth, this.#sliderHeigthStep);
            this.#sliderCalc(steps, heightPrice, operator);
            this.#sliderHeigth = heigthVal;
        }

        sliderCalcWidth(widthVal, widthPrice, operator) {
            let steps = this.#sliderCalcSteps(widthVal, this.#sliderWidth, this.#sliderWidthStep);
            this.#sliderCalc(steps, widthPrice, operator);
            this.#sliderWidth = widthVal;
        }

        sliderCalcDepth(depthVal, depthPrice, operator) {
            let steps = this.#sliderCalcSteps(depthVal, this.#sliderDepth, this.#sliderDepthStep);
            this.#sliderCalc(steps, depthPrice, operator);
            this.#sliderDepth = depthVal;
        }

        #sliderCalcSteps(selectSize, oldSize, step) {
            let calcSteps = Math.abs((oldSize - selectSize) / step);
            if (calcSteps != 0) {
                return calcSteps;
            } else {
                return 1;
            }
        }

        #sliderCalc(steps, price, operator) {
            if (operator == 'plus') {
                for (let i = 0; i < steps; i++) {
                    let calcPrice = this.#totalPrice + Number(price);
                    this.#setCalcPrice(Math.ceil(calcPrice / 100) * 100, this.#calcSalePrice(calcPrice));
                    this.#totalPrice = calcPrice;
                }
            }
            if (operator == 'minus') {
                for (let i = 0; i < steps; i++) {
                    let calcPrice = this.#totalPrice - Number(price);
                    this.#setCalcPrice(Math.ceil(calcPrice / 100) * 100, this.#calcSalePrice(calcPrice));
                    this.#totalPrice = calcPrice;
                }
            }
        }
    }

    const productCalculator = new ProductCalculator('#constructor_price', '#constructor_price_old', '#constructor_height_val', '#constructor_width_val', '#constructor_depth_val');


    // Вобор элемента калькулятора
    const calcSelects = document.querySelectorAll('.calc-el__list-item');

    calcSelects.forEach(el => {

        el.addEventListener('click', () => {

            document.querySelectorAll('.calc-el--active').forEach(el => {
                el.classList.remove('calc-el--active');
            });

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
                productCalculator.sliderCalcHeight(hendleVal, heightPrice, 'minus');
                startHeight = hendleVal;
            } else {
                productCalculator.sliderCalcHeight(hendleVal, heightPrice, 'plus');
                startHeight = hendleVal;
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

        sliderW.noUiSlider.on('slide', function (values, handle) {

            let item_size_width = document.getElementById("constructor_width");
            let item_size_width_val = document.getElementById("constructor_width_val");
            item_size_width.innerHTML = Math.trunc(values[handle]);
            item_size_width_val.innerHTML = `${Math.trunc(values[handle])} см`;

            let hendleVal = Math.trunc(sliderW.noUiSlider.get());

            if (startWidth > hendleVal) {
                productCalculator.sliderCalcWidth(hendleVal, widthPrice, 'minus');
                startWidth = hendleVal;
            } else {
                productCalculator.sliderCalcWidth(hendleVal, widthPrice, 'plus');
                startWidth = hendleVal;
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
                productCalculator.sliderCalcDepth(hendleVal, depthPrice, 'minus');
                startDepth = hendleVal
            } else {
                productCalculator.sliderCalcDepth(hendleVal, depthPrice, 'plus');
                startDepth = hendleVal
            }
        });

    }

}

