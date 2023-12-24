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

    async function cartCounter(id, countSelector, price, controller, totalPrice, totalCount) {
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

        totalCount.textContent = data.total_count_with_words

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

        const sidebarCounterBtnPlus = document.querySelector('.counter__btn-plus');
        const sidebarCounterBtnMin = document.querySelector('.counter__btn-min');

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

            sidebarCounterBtnPlus.setAttribute('data-product-id', data.itemKey);
            sidebarCounterBtnMin.setAttribute('data-product-id', data.itemKey);

        }


        addToCartBtn.addEventListener('click', () => {
            showSideBar();
            addToCart();

            sidebarCounterBtnPlus.addEventListener('click', (e)=> {
                const id = e.target.getAttribute('data-product-id');

                if (Number(sidebarProductCounterVal.textContent) < 50) {
                    headerBag.plus();
                    cartCounter(id, sidebarProductCounterVal, sidebarProductPrice, 'plus', sidebarTotalPrice, sidebarTotalCount);
                }

            });

            sidebarCounterBtnMin.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-product-id');
                if (Number(sidebarProductCounterVal.textContent) > 1) {
                    headerBag.minus();
                    cartCounter(id, sidebarProductCounterVal, sidebarProductPrice, 'minus', sidebarTotalPrice, sidebarTotalCount);
                }
            });

        });

    }

    if (document.querySelector('.cart')) {

        const countBtnsPlus = document.querySelectorAll('.cart-score__plus');
        const countBtnsMin = document.querySelectorAll('.cart-score__min');
        const totalCartPrice = document.querySelector('.total__cart__price');
        const totalCount = document.querySelector('.cart__val');

        countBtnsPlus.forEach(el => {
            el.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-product-id');
                const selector = e.target.parentNode.querySelector('.counter__val');
                const price = e.target.parentNode.parentNode.querySelector('.cart-el__price-inner');

                if (Number(selector.textContent) < 50) {
                    headerBag.plus();
                    cartCounter(id, selector, price, 'plus', totalCartPrice, totalCount);
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
                    cartCounter(id, selector, price, 'minus', totalCartPrice, totalCount);
                }
            });
        })

    }

}