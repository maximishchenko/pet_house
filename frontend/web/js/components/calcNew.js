'use strict'
import HcSticky from 'hc-sticky';
import noUiSlider from 'nouislider';

new HcSticky('.sidebar', {
    stickTo: '.product__col',
    top: 100,
    bottom: 100
});

class CageCalc {
    totalPrice;

    constructor(totalPriceSelector, oldTotalPriceSelector) {

        this.totalPriceSelector = document.querySelector(totalPriceSelector);
        this.oldTotalPriceSelector = document.querySelector(oldTotalPriceSelector);
        this.totalPrice = this.getPrice(this.totalPriceSelector);

    }

    calc(type, val1, val2) {

        if (type == 'btnCalc') {

            let price = this.totalPrice - val1 + val2;
            this.#setTortalPrice(price, this.#calcSale(price));
            this.totalPrice = price;

        } else if (type == 'sliderCalc') {

            let price = this.totalPrice + (val1 * val2);
            this.#setTortalPrice(price, this.#calcSale(price));
            this.totalPrice = price;

        }

    }

    getPrice(selector) {
        return Number(selector.textContent.split(' ').join(''));
    }

    #calcSale(price) {

        return Math.trunc(price + ((price * 10) / 100));

    }

    #setTortalPrice(price, oldPrice) {

        this.totalPriceSelector.textContent = price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
        this.oldTotalPriceSelector.textContent = oldPrice.toLocaleString('ru-RU', { minimumFractionDigits: 0 });

    }

}

class SliderCalc extends CageCalc {
    sliderPrice;


    constructor(totalPriceSelector, oldTotalPriceSelector) {
        super(totalPriceSelector, oldTotalPriceSelector)

    }

    log() {
        let teat = this.sliderPrice = this.getPrice(this.totalPriceSelector)
        console.log(teat)
    }
}
/* 
let cageCalcBtn = new CageCalc('#constructor_price', '#constructor_price_old');
let test = new SliderCalc('#constructor_price', '#constructor_price_old');
 */

class ProductCalc {


    constructor(totalPriceSelector, oldTotalPriceSelector) {
        this.totalPriceSelector = document.querySelector(totalPriceSelector);
        this.oldTotalPriceSelector = document.querySelector(oldTotalPriceSelector);
    }

    calc(type, totalPrice, val1, val2) {

        if (type == 'btnCalc') {

            let price = totalPrice - val1 + val2;
            this.#setTortalPrice(price, this.#calcSale(price));

        } else if (type == 'sliderCalc') {

            let price = totalPrice + (val1 * val2);
            this.#setTortalPrice(price, this.#calcSale(price));

        }

    }

    getPrice(selector) {
        return Number(selector.textContent.split(' ').join(''));
    }

    #calcSale(price) {

        return Math.trunc(price + ((price * 10) / 100));

    }

    #setTortalPrice(price, oldPrice) {

        this.totalPriceSelector.textContent = price/* .toLocaleString('ru-RU', { minimumFractionDigits: 0 }) */;
        this.oldTotalPriceSelector.textContent = oldPrice/* .toLocaleString('ru-RU', { minimumFractionDigits: 0 }) */;

    }

}

class SliderProductCalc extends ProductCalc {
    #params;
    constructor(totalPriceSelector, oldTotalPriceSelector, CageParamsSelector) {
        super(totalPriceSelector, oldTotalPriceSelector);
        this.CageParamsSelector = document.querySelector(CageParamsSelector);
        this.#params = {
            height: Number(this.CageParamsSelector.getAttribute('data-height-price')),
            width: Number(this.CageParamsSelector.getAttribute('data-width-price')),
            depth: Number(this.CageParamsSelector.getAttribute('data-depth-price')),
        }
    }

    slCalc(val, sizeType) {
        this.calc('sliderCalc', this.getPrice(this.totalPriceSelector), val, this.#checkType(sizeType));
    }

    #checkType(type) {
        let cageTypes = Object.keys(this.#params);
        if (cageTypes.includes(type)) {
            return this.#params[type];
        } else {
            throw new Error('Incorrect Param Type');
        }
    }
}

class BtnProductCalc extends ProductCalc {
    constructor(totalPriceSelector, oldTotalPriceSelector) {
        super(totalPriceSelector, oldTotalPriceSelector);
    }

    btnCalc(val1, val2) {
        this.calc('btnCalc', this.getPrice(this.totalPriceSelector), val1, val2);
    }
}



let buttonCalc = new BtnProductCalc('#constructor_price', '#constructor_price_old');

// Показать/скрыть элемент кеалькулятора
document.querySelectorAll('.calc-el__btn-control').forEach(el => {
    el.addEventListener('click', () => {
        el.parentNode.classList.toggle('calc-el--active');
    })
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

        // Удалить условие после испровления
        const priceOld = Number(el.parentNode.querySelector('.calc-el__list-item--active').getAttribute('data-price'));

        unselectAllCalcSelects();
        el.classList.add('calc-el__list-item--active');

        if (el.parentNode.classList.contains('calc-el__list--color')) {
            const colorPrice = Number(el.getAttribute('data-price'));
            const colorImg = document.querySelector('#calc-color-img');
            const colorTitle = document.querySelector('#calc-color-title');
            colorImg.style.backgroundImage = el.style.backgroundImage;
            colorTitle.textContent = el.getAttribute('data-color-name');
            buttonCalc.btnCalc(priceOld, colorPrice)
        }

        if (el.parentNode.classList.contains('calc-el__list--size')) {
            const colorPrice = el.getAttribute('data-price');
            const constructorHeight = document.querySelector('#constructor_height');
            const constructorWidth = document.querySelector('#constructor_width');
            const constructorDepth = document.querySelector('#constructor_depth');
            constructorHeight.textContent = el.getAttribute('data-size-height');
            constructorWidth.textContent = el.getAttribute('data-size-width');
            constructorDepth.textContent = el.getAttribute('data-size-depth');


            buttonCalc.btnCalc(priceOld, colorPrice)
        }

        if (el.parentNode.classList.contains('calc-el__list--walls')) {
            const colorPrice = el.getAttribute('data-price');
            const wallsImg = document.querySelector('#calc-walls-img');
            const wallsTitle = document.querySelector('#calc-walls-title');
            wallsImg.style.backgroundImage = el.style.backgroundImage;
            wallsTitle.textContent = el.getAttribute('data-wall-name');


            buttonCalc.btnCalc(priceOld, colorPrice)
        }

    });
});



const sliderH = document.getElementById('slider-h');
const sliderW = document.getElementById('slider-w');
const sliderD = document.getElementById('slider-g');

if (sliderH != null && sliderW != null && sliderD != null) {

    let sliderCalc = new SliderProductCalc('#constructor_price', '#constructor_price_old', '#dogCageSizeParams');

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
            sliderCalc.slCalc(-1, 'height');
            startHeight = hendleVal;
        } else {
            startHeight = hendleVal;
            sliderCalc.slCalc(1, 'height');
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
            sliderCalc.slCalc(-1, 'width');
            startWidth = hendleVal;
        } else {
            sliderCalc.slCalc(1, 'width');
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
            sliderCalc.slCalc(-1, 'depth');
            startDepth = hendleVal
        } else {
            sliderCalc.slCalc(1, 'depth');
            startDepth = hendleVal
        }
    });
}


// let stepPrice = dogCageAttributes.getStepPrice('width');
// let resultPrice = dog.setPrice(1, stepPrice);
// console.log(resultPrice);


// onclide
// dog.setPrice(1, dogCageAttributes.getStepPrice())


/* 5000 + (2 * 100)
5000 + (-1 * 100) */
