const sizeItem = document.querySelectorAll('.size-item');
const colorItem = document.querySelectorAll('.color-item');
const wallItem = document.querySelectorAll('.wall-item');

sizeItem?.forEach(item => {
    item.addEventListener('click', () => {

        let size_height = item.getAttribute("data-size-height");
        let size_width = item.getAttribute("data-size-width");
        let size_depth = item.getAttribute("data-size-depth");
        let size_id = item.getAttribute('data-size-id');

        let item_size_height = document.getElementById("constructor_height");
        let item_size_width = document.getElementById("constructor_width");
        let item_size_depth = document.getElementById("constructor_depth");

        let item_size = document.querySelector('span[data-constructor-size-id]');

        item_size_height.innerHTML = size_height;
        item_size_width.innerHTML = size_width;
        item_size_depth.innerHTML = size_depth;

        item_size.setAttribute("data-constructor-size-id", size_id);
        item_size.setAttribute("data-constructor-size-height", size_height);
        item_size.setAttribute("data-constructor-size-width", size_width);
        item_size.setAttribute("data-constructor-size-depth", size_depth);

        getConstructorPriceAjax()

    })
});
colorItem?.forEach(item => {
    item.addEventListener('click', () => {
        let color_name = item.getAttribute('data-color-name');
        let color_image = item.getAttribute('data-color-image');
        let color_id = item.getAttribute('data-color-id');

        let item_color_name = document.querySelector('span[data-constructor-color-name]');
        let item_color_image = document.querySelector('span[data-constructor-color-image]');
        item_color_name.innerHTML = color_name;
        item_color_image.style.backgroundImage = "url(" + color_image + ")";
        item_color_image.setAttribute("data-constructor-color-id", color_id);

        getConstructorPriceAjax()
    })
});
wallItem.forEach(item => {
    item.addEventListener('click', () => {
        let wall_name = item.getAttribute("data-wall-name");
        let wall_id = item.getAttribute("data-wall-id");

        /* console.log(item);
        console.log(wall_name);
        console.log(wall_id); */

        let item_wall = document.querySelector('span[data-constructor-wall-name]');
        let item_wall_id = document.querySelector('span[data-constructor-wall-id]');
        item_wall.innerHTML = wall_name;
        item_wall_id.setAttribute('data-constructor-wall-id', wall_id);

        getConstructorPriceAjax()
    })
});


function getConstructorData() {

    let constructorProduct = document.querySelector('div[data-product-id]');
    let constructorProductId = constructorProduct.getAttribute("data-product-id");
    let constructorCsrfParam = constructorProduct.getAttribute("data-csrf-param");
    let constructorCsrfToken = constructorProduct.getAttribute("data-csrf-token");

    let constructorProductColor = document.querySelector('span[data-constructor-color-id]');
    let constructorProductColorId = constructorProductColor.getAttribute("data-constructor-color-id");

    // let constructorProductSize = document.querySelector('span[data-constructor-size-id]');
    // let constructorProductSizeId = constructorProductSize.getAttribute("data-constructor-size-id");

    let constructorProductSizeHeight = document.querySelector('span[data-constructor-size-height]');
    let constructorProductSizeHeightValue = constructorProductSizeHeight.getAttribute("data-constructor-size-height");

    let constructorProductSizeWidth = document.querySelector('span[data-constructor-size-width]');
    let constructorProductSizeWidthValue = constructorProductSizeWidth.getAttribute("data-constructor-size-width");

    let constructorProductDepthSize = document.querySelector('span[data-constructor-size-depth]');
    let constructorProductSizeDepthValue = constructorProductDepthSize.getAttribute("data-constructor-size-depth");

    let constructorProductWall = document.querySelector('span[data-constructor-wall-id]');
    let constructorProductWallId = constructorProductWall.getAttribute("data-constructor-wall-id");


    data = {
        'product_id': constructorProductId,
        'color': constructorProductColorId,
        'height': constructorProductSizeHeightValue,
        'width': constructorProductSizeWidthValue,
        'depth': constructorProductSizeDepthValue,
        'walls': constructorProductWallId,
        '_csrf': constructorCsrfToken,
    };
    return new URLSearchParams(data).toString();
}

async function getConstructorPriceAjax() {
    fetch(`/catalog/default/calculate-price-constructor?${getConstructorData()}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then((response) => {
            if (!response.ok) {
                window.location.reload();
            }
            return response.json()
        })
        .then(data => {
            priceValueFormatted = data.price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            oldPriceValueFormatted = data.old_price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });

            document.getElementById("constructor_price").textContent = priceValueFormatted;
            if (data.price < data.old_price) {
                document.getElementById("constructor_price_old").innerHTML = oldPriceValueFormatted;
            }
        })
}


const accesSlider = document.querySelector('.add-accessories');
const cartContainer = document.querySelector('.cart-container');
const listContainer = document.querySelector('.cart__list');

if (listContainer != null) {
    function cartAdapt() {
        if (screen.width < 768) {
            cartContainer.appendChild(accesSlider);
        } else {
            /* listContainer.appendChild(accesSlider); */
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        cartAdapt();
    });

    window.addEventListener('resize', function () {
        cartAdapt();
    });

}

const cartSidebar = document.querySelector('.cart-sidebar');
const cartSidebarBg = document.querySelector('.cart-sidebar__bg');
const cartSidebarBtnCloase = document.querySelector('.cart-sidebar__btn-close');
const addToCartBtn = document.querySelector('.product__action-btn');

function sideBarToggle() {
    cartSidebar.classList.toggle('cart-sidebar--active');
    document.querySelector('.page').classList.toggle('dis-scroll');
}

function addToCart() {

    fetch(`/cart/default/add-to-cart?${getConstructorData()}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then((response) => {
            if (!response.ok) {
                window.location.reload();
            }
            return response.json()
        })
        .then(data => {
            document.querySelector(".cart-sidebar-title-item").innerHTML = data.name;
            document.querySelector(".cart-sidebar-img-item").src = data.image;
            document.querySelector(".cart-sidebar-count-item").innerHTML = data.count;
            document.querySelector(".cart-sidebar-price-item").innerHTML = data.price.price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            document.querySelector(".cart-sidebar-totalcount-item").innerHTML = data.total_count;
            document.querySelector(".cart-sidebar-totalprice-item").innerHTML = data.total_price;
            document.querySelector(".counter__btn-min").setAttribute('data-product-id', data.product_id);
            document.querySelector(".counter__btn-plus").setAttribute('data-product-id', data.product_id);
            sideBarToggle();
        });
}

if (addToCartBtn != null) {
    addToCartBtn.addEventListener('click', () => {
        addToCart()
    })
}
if (cartSidebarBg != null) {
    cartSidebarBg.addEventListener('click', () => {
        sideBarToggle();
    })
}
if (cartSidebarBtnCloase != null) {
    cartSidebarBtnCloase.addEventListener('click', () => {
        sideBarToggle();
    })
}


function updateCartCount(product_id, count) {
    fetch(`/cart/update-product-count?product_id=${product_id}&count=${count}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then((response) => {
            if (!response.ok) {
                window.location.reload();
            }
            return response.json()
        }).then(data => {
            let price = data.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            document.querySelector(".total__cart__price").textContent = price;
        })
}

const counterVal = document.querySelector('.counter__val');
const counterDec = document.querySelector('.counter__btn-min');
const counterInc = document.querySelector('.counter__btn-plus');

if (counterVal != null && counterDec != null && counterInc != null) {


    let cartCounter = counterVal.textContent; //TODO При загрузки страницы суда попадает '<!-- 2 -->' по этому он себя так и ведет


    counterInc.addEventListener('click', () => {

        let product_id = counterInc.getAttribute('data-product-id');

        if (cartCounter < 50) {
            cartCounter++
            counterVal.textContent = cartCounter;
            updateCartCount(product_id, cartCounter);
        }
    })

    counterDec.addEventListener('click', () => {

        let product_id = counterDec.getAttribute('data-product-id');

        if (cartCounter > 1) {
            cartCounter--
            counterVal.textContent = cartCounter;
            updateCartCount(product_id, cartCounter);
        }
    })

}
