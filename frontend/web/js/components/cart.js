if (document.querySelector('.product__col-calc') || document.querySelector('.cart')) {

    const fetchHeaders = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
        'X-Requested-With': 'XMLHttpRequest'
    }

    function toLocale(number) {
        let val = Math.ceil(Number(number) / 100) * 100
        return val.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
    }

    class HeaderBag {

        constructor(bagSelector, bagValueSelector) {
            this.bagSelector = document.querySelector(bagSelector);
            this.bagValueSelector = document.querySelector(bagValueSelector);
        }

        #getVal() {
            return Number(this.bagValueSelector.textContent);
        }

        #setVal(val) {
            this.bagValueSelector.textContent = val;

            if (!this.bagSelector.classList.contains('.bag-icon--acrive')) {
                this.bagSelector.classList.add('bag-icon--acrive');
            }

        }

        plus() {
            this.#setVal(this.#getVal() + 1);
        }

        minus() {

            if (this.#getVal() > 1) {
                this.#setVal(this.#getVal() - 1);
            }

            if (this.#getVal() == 0) {
                this.bagSelector.classList.remove('bag-icon--acrive');
                this.bagValueSelector.textContent = '';
            }

        }

    }

    const headerBag = new HeaderBag('.header__bag', '.cart-val');

    async function cartCounter(id, countSelector, price, controller, totalPrice) {
        let counterVal = Number(countSelector.textContent);
        let priceVal = Number(price.textContent.replace(/\D/g, ''));
        let totalPriceVal = Number(totalPrice.textContent.replace(/\D/g, ''));
        let priceForOne = priceVal;
        let calcCount = 1;
        

        if (counterVal !== 1) {
            priceForOne = priceVal / counterVal;
        }

        if (controller == 'plus' && counterVal < 50) {
            const count = counterVal + 1;
            countSelector.textContent = count;
            price.textContent = toLocale(priceVal + priceForOne);
            totalPrice.textContent = toLocale(totalPriceVal + priceForOne);

            calcCount = count;
        }
        if (controller == 'minus' && counterVal > 1) {
            const count = counterVal - 1;
            countSelector.textContent = count;
            price.textContent = toLocale(priceVal - priceForOne);
            totalPrice.textContent = toLocale(totalPriceVal - priceForOne);
            
            calcCount = count;
        }

        
        const res = await fetch(`/cart/default/update-product-count?itemKey=${id}&count=${calcCount}`, {
            headers: fetchHeaders
        });

        const data = await res.json();

    }

    if (document.querySelector('.product__col-calc')) {

        const addToCartBtn = document.querySelector('.product__action-btn');
        const sideBar = document.querySelector('.cart-sidebar');
        const sideBarBg = document.querySelector('.cart-sidebar__bg');
        const sideBarBtnClose = document.querySelector('.cart-sidebar__btn-close');

        function showSideBar() {
            sideBar.classList.add('cart-sidebar--active');
            document.querySelector('.page').classList.add('dis-scroll');
            sideBarBg.addEventListener('click', hideSideBar);
            sideBarBtnClose.addEventListener('click', hideSideBar);
        }

        function hideSideBar() {
            sideBar.classList.remove('cart-sidebar--active');
            document.querySelector('.page').classList.remove('dis-scroll');
            sideBarBg.removeEventListener('click', hideSideBar);
            sideBarBtnClose.removeEventListener('click', hideSideBar);

        }

        const sidebarProductImg = document.querySelector('.cart-sidebar-el__img');
        const sidebarProductTitle = document.querySelector('.cart-sidebar-el__title');
        const sidebarProductPrice = document.querySelector('.cart-sidebar-price-item');
        const sidebarProductCounterVal = document.querySelector('.cart-sidebar-count-item');
        const sidebarTotalPrice = document.querySelector('.cart-sidebar-totalprice-item');
        const sidebarTotalCount = document.querySelector('.cart-sidebar-totalcount-item');

        async function addToCart() {
            headerBag.plus();

            const productId = document.querySelector('.product__col-calc').getAttribute('data-product-id');
            const productPrice = document.querySelector('#constructor_price').textContent.replace(/\D/g, '');
            const calcElements = document.querySelectorAll('.calc-el__list-item--active');
            let urlParams = `/cart/default/add-to-cart?product_id=${productId}&price=${productPrice}`;

            calcElements.forEach(el => {
                if (el.classList.contains('color-item')) {
                    urlParams = urlParams + `&color=${el.getAttribute('data-color-id')}`
                }
                else if (el.classList.contains('size-item')) {
                    urlParams = urlParams + `&height=${el.getAttribute('data-size-height')}`
                    urlParams = urlParams + `&width=${el.getAttribute('data-size-width')}`
                    urlParams = urlParams + `&depth=${el.getAttribute('data-size-depth')}`
                }
                else if (el.classList.contains('wall-item')) {
                    urlParams = urlParams + `&walls=${el.getAttribute('data-wall-id')}`
                }
            });

            if (document.querySelector('#dogCageSizeParams')) {
                const heigth = document.querySelector('#constructor_height').textContent,
                    width = document.querySelector('#constructor_width').textContent,
                    depth = document.querySelector('#constructor_depth').textContent;

                urlParams = urlParams + `&height=${heigth}`
                urlParams = urlParams + `&width=${width}`
                urlParams = urlParams + `&depth=${depth}`

            }

            const res = await fetch(urlParams, {
                headers: fetchHeaders
            });
            const data = await res.json();

            sidebarProductImg.src = data.image;
            sidebarProductTitle.textContent = data.name;
            sidebarProductPrice.textContent = toLocale(data.price);
            sidebarProductCounterVal.textContent = data.total_count_per_one_product;

            sidebarTotalPrice.textContent = toLocale(data.total_price);
            sidebarTotalCount.textContent = data.total_count_per_one_product_with_words;

        }

        addToCartBtn.addEventListener('click', () => {
            showSideBar();
            addToCart();
        });

    }

    if (document.querySelector('.cart')) {

        const countBtnsPlus = document.querySelectorAll('.cart-score__plus');
        const countBtnsMin = document.querySelectorAll('.cart-score__min');
        const totalCartPrice = document.querySelector('.total__cart__price');

        countBtnsPlus.forEach(el => {
            el.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-product-id');
                const selector = e.target.parentNode.querySelector('.counter__val');
                const price = e.target.parentNode.parentNode.querySelector('.cart-el__price-inner');

                if (Number(selector.textContent) < 50) {
                    headerBag.plus();
                    cartCounter(id, selector, price, 'plus', totalCartPrice);
                }
            });
        })

        countBtnsMin.forEach(el => {
            el.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-product-id');
                const selector = e.target.parentNode.querySelector('.counter__val');
                const price = e.target.parentNode.parentNode.querySelector('.cart-el__price-inner');

                if (Number(selector.textContent) > 1) {
                    headerBag.minus();
                    cartCounter(id, selector, price, 'minus', totalCartPrice);
                }
            });
        })

    }

}


/* const fetchHeaders = {
    'Content-Type': 'application/x-www-form-urlencoded',
    'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
    'X-Requested-With': 'XMLHttpRequest'
}
const headerBag = document.querySelector('.header__bag');
const headerBagVal = document.querySelector('.cart-val');
let headerBagValNum = Number(headerBagVal.textContent);


function toLocale(number) {
    let val = Math.ceil(Number(number) / 100) * 100
    return val.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
}


if (document.querySelector('.product__col-calc')) {

    const addToCartBtn = document.querySelector('.product__action-btn');
    const sideBar = document.querySelector('.cart-sidebar');
    const sideBarBg = document.querySelector('.cart-sidebar__bg');
    const sideBarBtnClose = document.querySelector('.cart-sidebar__btn-close');
    const countPlus = document.querySelector('.counter__btn-plus');
    const countMin = document.querySelector('.counter__btn-min');

    function showSideBar() {
        sideBar.classList.add('cart-sidebar--active');
        document.querySelector('.page').classList.add('dis-scroll');
        sideBarBg.addEventListener('click', hideSideBar);
        sideBarBtnClose.addEventListener('click', hideSideBar);

        countPlus.addEventListener('click', (e) => {
            sideBarCounterCalc(e.target)
        });

        countMin.addEventListener('click', (e) => {
            sideBarCounterCalc(e.target)
        });
    }

    function hideSideBar() {
        sideBar.classList.remove('cart-sidebar--active');
        document.querySelector('.page').classList.remove('dis-scroll');
        sideBarBg.removeEventListener('click', hideSideBar);
        sideBarBtnClose.removeEventListener('click', hideSideBar);
        countPlus.removeEventListener('click', sideBarCounterCalc);
        countMin.removeEventListener('click', sideBarCounterCalc);
    }

    const sideBarImg = document.querySelector('.cart-sidebar-el__img');
    const sideBarCounter = document.querySelector('.cart-sidebar-count-item');
    const sideBarProductPrice = document.querySelector('.cart-sidebar-price-item');
    const sideBarTotalPrice = document.querySelector('.cart-sidebar-totalprice-item');
    const sideBarTotalCart = document.querySelector('.cart-sidebar-totalcount-item');
    const sideBarTitle = document.querySelector('.cart-sidebar-el__title');
    const counterBtn = document.querySelectorAll('[data-product-id]');
    const totalPriceSelector = document.querySelector('.total__cart__price');


    async function addToCart() {

        const productId = document.querySelector('.product__col-calc').getAttribute('data-product-id');
        const productPrice = document.querySelector('#constructor_price').textContent.replace(/\D/g, '');
        const calcElements = document.querySelectorAll('.calc-el__list-item--active');
        let urlParams = `/cart/default/add-to-cart?product_id=${productId}&price=${productPrice}`

        calcElements.forEach(el => {
            if (el.classList.contains('color-item')) {
                urlParams = urlParams + `&color=${el.getAttribute('data-color-id')}`
            }
            else if (el.classList.contains('size-item')) {
                urlParams = urlParams + `&height=${el.getAttribute('data-size-height')}`
                urlParams = urlParams + `&width=${el.getAttribute('data-size-width')}`
                urlParams = urlParams + `&depth=${el.getAttribute('data-size-depth')}`
            }
            else if (el.classList.contains('wall-item')) {
                urlParams = urlParams + `&walls=${el.getAttribute('data-wall-id')}`
            }
        });

        if (document.querySelector('#dogCageSizeParams')) {
            const heigth = document.querySelector('#constructor_height').textContent,
                width = document.querySelector('#constructor_width').textContent,
                depth = document.querySelector('#constructor_depth').textContent;

            urlParams = urlParams + `&height=${heigth}`
            urlParams = urlParams + `&width=${width}`
            urlParams = urlParams + `&depth=${depth}`

        }
        
        const res = await fetch(urlParams, {
            headers: fetchHeaders
        });
        const data = await res.json();

        if (!headerBag.classList.contains('bag-icon--acrive')) {
            headerBag.classList.add('bag-icon--acrive');
        }
        headerBagVal.textContent = data.total_count;

        sideBarImg.src = data.image;
        sideBarTitle.textContent = data.name;
        sideBarCounter.textContent = data.total_count_per_one_product;
        sideBarProductPrice.textContent = toLocale(data.price);
        sideBarTotalPrice.textContent = toLocale(data.total_price);
        sideBarTotalCart.textContent = data.total_count_per_one_product_with_words;

        counterBtn.forEach(el => {
            el.setAttribute('data-product-key', data.itemKey);
        });
    }

    async function sideBarCounterCalc(el) {
        let val = Number(sideBarCounter.textContent);
        const id = document.querySelector('[data-product-key]').getAttribute('data-product-key');

        if (el.classList.contains('counter__btn-plus') && val < 10) {
            val = val + 1;
            sideBarCounter.textContent = val;
            const res = await fetch(`/cart/default/update-product-count?itemKey=${id}&count=${val}`, {
                headers: fetchHeaders
            });
            headerBagVal.textContent = val;
            const data = await res.json(); 
            console.log(data);
            
            totalPriceSelector.textContent = toLocale(data.total_price);

        } else if (el.classList.contains('counter__btn-min')) {
            val = val -1;
            sideBarCounter.textContent = val;
            const res = await fetch(`/cart/default/update-product-count?itemKey=${id}&count=${val}`, {
                headers: fetchHeaders
            });

            const data = await res.json();
            console.log(data);
            
            headerBagVal.textContent = val;
            totalPriceSelector.textContent = toLocale(data.total_price);

        }
    }

    addToCartBtn.addEventListener('click', () => {
        showSideBar();
        addToCart();
    });

}

if (document.querySelector('.cart')) {

    const btnPlus = document.querySelectorAll('.counter__btn-plus');
    const btnMinus = document.querySelectorAll('.counter__btn-min');
    const totalPriceSelector = document.querySelector('.total__cart__price');

    function cartCounter() {

        btnPlus.forEach(el => {
            el.addEventListener('click', () => {
                let valSelector = el.parentNode.querySelector('.cart-score__val');
                let val = Number(valSelector.textContent);
                let priceSelector = el.parentNode.parentNode.querySelector('.cart-el__price');
                let price = Number(priceSelector.textContent.replace(/\D/g, ''));
                let id = el.getAttribute('data-product-id');

                let totalPrice = Number(totalPriceSelector.textContent.replace(/\D/g, ''));

                if (val < 10) {
                    valSelector.textContent = val + 1;
                    headerBagVal.textContent = headerBagValNum + 1;
                    headerBagValNum = headerBagValNum + 1;
                    let priceProd = price / val;
                    priceSelector.textContent = `${toLocale(price + priceProd)} ₽`;

                    totalPriceSelector.textContent = toLocale(totalPrice + priceProd);

                    fetch(`/cart/default/update-product-count?itemKey=${id}&count=${val + 1}`, {
                        headers: fetchHeaders
                    })
                }

            });
        });

        btnMinus.forEach(el => {
            el.addEventListener('click', () => {
                let valSelector = el.parentNode.querySelector('.cart-score__val');
                let val = Number(valSelector.textContent);
                let priceSelector = el.parentNode.parentNode.querySelector('.cart-el__price');
                let price = Number(priceSelector.textContent.replace(/\D/g, ''));
                let id = el.getAttribute('data-product-id');

                let totalPrice = Number(totalPriceSelector.textContent.replace(/\D/g, ''));

                if (val > 1) {
                    valSelector.textContent = val - 1;
                    headerBagVal.textContent = headerBagValNum - 1;
                    headerBagValNum = headerBagValNum - 1;
                    let priceProd = Number(price) / val;
                    priceSelector.textContent = `${toLocale(price - priceProd)} ₽`;

                    totalPriceSelector.textContent = toLocale(totalPrice - priceProd);

                    fetch(`/cart/default/update-product-count?itemKey=${id}&count=${val - 1}`, {
                        headers: fetchHeaders
                    })
                }

            });
        });
    }

    cartCounter();
}
 */