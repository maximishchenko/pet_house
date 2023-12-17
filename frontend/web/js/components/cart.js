

function toLocale(number) {
    return Number(number).toLocaleString('ru-RU', { minimumFractionDigits: 0 });
}

if (document.querySelector('.product__col-calc')) {

    const fetchHeaders = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
        'X-Requested-With': 'XMLHttpRequest'
    }

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

    const headerBag = document.querySelector('.header__bag');
    const headerBagVal = document.querySelector('.cart-val');
    const sideBarImg = document.querySelector('.cart-sidebar-el__img');
    const sideBarCounter = document.querySelector('.cart-sidebar-count-item');
    const sideBarProductPrice = document.querySelector('.cart-sidebar-price-item');
    const sideBarTotalPrice = document.querySelector('.cart-sidebar-totalprice-item');
    const sideBarTotalCart = document.querySelector('.cart-sidebar-totalcount-item');
    const sideBarTitle = document.querySelector('.cart-sidebar-el__title');
    const counterBtn = document.querySelectorAll('[data-product-id]');

    async function addToCart() {

        const productId = document.querySelector('[data-product-id]').getAttribute('data-product-id');
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
            el.setAttribute('data-product-id', data.product_id);
        });
    }

    addToCartBtn.addEventListener('click', () => {
        showSideBar();
        addToCart();
    });

}


function cartCounter() {
    
}