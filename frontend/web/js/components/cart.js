
const addToCartBtn = document.querySelector('.product__action-btn'),
    sideBar = document.querySelector('.cart-sidebar'),
    sideBarBtn = document.querySelector('.cart-sidebar__btn-close'),
    sideBarBg = document.querySelector('.cart-sidebar__bg'),
    sidebarProductTitle = document.querySelector('.cart-sidebar-title-item'),
    sidebarProductImg = document.querySelector('.cart-sidebar-el__img'),
    sidebarProductPrice = document.querySelector('.cart-sidebar-price-item'),
    sidebarProductCountVal = document.querySelector('.counter__val'),
    sidebarTotalCount = document.querySelector('.cart-sidebar-count-item'),
    sidebarTotalPrice = document.querySelector('.cart-sidebar-totalprice-item');

function toLocale(number) {
    return number.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
}

async function addToCart() {
    const productId = document.querySelector('[data-product-id]').getAttribute('data-product-id'),
        calcElements = document.querySelectorAll('.calc-el__list-item--active'),
        productParams = {},
        productPrice = document.querySelector('#constructor_price').textContent.replace(/\D/g, ''),
        productOldPrice = document.querySelector('#constructor_price_old').textContent.replace(/\D/g, '');


    calcElements.forEach(el => {
        if (el.classList.contains('color-item')) {
            productParams.color = el.getAttribute('data-color-id');
        }
        else if (el.classList.contains('size-item')) {
            productParams.size = {
                heigth: el.getAttribute('data-size-height'),
                width: el.getAttribute('data-size-width'),
                depth: el.getAttribute('data-size-depth')
            }
        }
        else if (el.classList.contains('wall-item')) {
            productParams.wall = el.getAttribute('data-wall-id');
        }
    });

    if (document.querySelector('#dogCageSizeParams')) {
        const heigth = document.querySelector('#constructor_height').textContent,
            width = document.querySelector('#constructor_width').textContent,
            depth = document.querySelector('#constructor_depth').textContent;

        productParams.size = {
            heigth: heigth,
            width: width,
            depth: depth
        }

        productParams.wall = 0;
    }

    productParams.price = Number(productPrice);
    productParams.oldPrice = Number(productOldPrice);

    const res = await fetch(`http://pet-house.local/cart/default/add-to-cart?product_id=${productId}&color=${productParams.color}&walls=${productParams.wall}&height=${productParams.size.heigth}&width=${productParams.size.width}&depth=${productParams.size.depth}&price=${productParams.price}&old_price=${productParams.oldPrice}`);
    const data = await res.json();
    
    sidebarProductTitle.textContent = data.name;
    sidebarProductImg.src = data.image;
    sidebarProductCountVal.textContent = data.count;
    sidebarProductPrice.textContent = toLocale(Number(data.price));
    sidebarTotalPrice.textContent = toLocale(data.total_price);
    sidebarTotalCount.textContent = data.total_count

    console.log(data);
    

}

function toggleSideBar() {
    sideBar.classList.toggle('cart-sidebar--active');
    document.querySelector('.page').classList.toggle('dis-scroll');
}

addToCartBtn?.addEventListener('click', () => {
    addToCart();
    toggleSideBar();
});

sideBarBg?.addEventListener('click', toggleSideBar);
sideBarBtn?.addEventListener('click', toggleSideBar);

async function cartCounter(id, count, selector) {
    const res = await fetch(`http://pet-house.local/cart/default/update-product-count?itemKey=${id}&count=${count}`);
    const data = await res.text();
    console.log(data);
    
}

cartCounter(0, 3)


// fetch('http://pet-house.local/cart/default/update-product-count?itemKey=0&count=15');

//http://pet-house.local/cart/default/update-product-count?product_id=123&count=15