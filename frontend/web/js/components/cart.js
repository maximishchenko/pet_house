import noUiSlider from 'nouislider';

const sizeItem = document.querySelectorAll('.size-item');
const colorItem = document.querySelectorAll('.color-item');
const wallItem = document.querySelectorAll('.wall-item');

sizeItem?.forEach(item => {
    item.addEventListener('click', () => {

        let size_height = item.getAttribute("data-size-height");
        let size_width = item.getAttribute("data-size-width");
        let size_depth = item.getAttribute("data-size-depth");
        let size_height_price = item.getAttribute("data-size-height-price");
        let size_width_price = item.getAttribute("data-size-width-price");
        let size_depth_price = item.getAttribute("data-size-depth-price");
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
        
        item_size.setAttribute("data-constructor-size-height-price", size_height_price);
        item_size.setAttribute("data-constructor-size-width-price", size_width_price);
        item_size.setAttribute("data-constructor-size-depth-price", size_depth_price);

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

    let constructorProductSizeHeightPrice = document.querySelector('span[data-constructor-size-height-price]');
    let constructorProductSizeHeightPriceValue = constructorProductSizeHeightPrice.getAttribute("data-constructor-size-height-price");

    let constructorProductSizeWidthPrice = document.querySelector('span[data-constructor-size-width-price]');
    let constructorProductSizeWidthPriceValue = constructorProductSizeWidthPrice.getAttribute("data-constructor-size-width-price");

    let constructorProductDepthSizePrice = document.querySelector('span[data-constructor-size-depth-price]');
    let constructorProductSizeDepthPriceValue = constructorProductDepthSizePrice.getAttribute("data-constructor-size-depth-price");

    let constructorProductWall = document.querySelector('span[data-constructor-wall-id]');
    let constructorProductWallId = constructorProductWall.getAttribute("data-constructor-wall-id");


    let data = {
        'product_id': constructorProductId,
        'color_id': constructorProductColorId,
        'wall_id': constructorProductWallId,
        'heightPrice': constructorProductSizeHeightPriceValue,
        'widthPrice': constructorProductSizeWidthPriceValue,
        'depthPrice': constructorProductSizeDepthPriceValue,
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
            let priceValueFormatted = data.price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            let oldPriceValueFormatted = data.old_price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });

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

            let cartCounter = counterVal.textContent;


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

    // TODO указать шаг, уточнить ценообразование
    const sliderH = document.getElementById('slider-h');
    const sliderW = document.getElementById('slider-w');
    const sliderG = document.getElementById('slider-g');

    if (sliderH != null && sliderW != null && sliderG != null) {

        let heightSlider = document.querySelector('#constructor_height_val')
        let startHeight = heightSlider.getAttribute("data-slider-height");
        let minHeight = heightSlider.getAttribute("data-slider-min-height");
        let maxHeight = heightSlider.getAttribute("data-slider-max-height");
        let stepHeight = heightSlider.getAttribute("data-slider-step-height");
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

        let widthSlider = document.querySelector('#constructor_width_val');
        let startWidth = widthSlider.getAttribute("data-slider-width");
        let minWidth = widthSlider.getAttribute("data-slider-min-width");
        let maxWidth = widthSlider.getAttribute("data-slider-max-width");
        let stepWidth = widthSlider.getAttribute("data-slider-step-width");
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

        let depthSlider = document.querySelector('#constructor_depth_val');
        let startDepth = depthSlider.getAttribute("data-slider-depth");
        let minDepth = depthSlider.getAttribute("data-slider-min-depth");
        let maxDepth = depthSlider.getAttribute("data-slider-max-depth");
        let stepDepth = depthSlider.getAttribute("data-slider-step-depth");
        noUiSlider.create(sliderG, {
            start: startDepth,
            connect: [true, false],
            step: Number(stepDepth),
            range: {
                'min': Number(minDepth) - 5,
                'max': Number(maxDepth) + 5,
            },
            padding: [5, 5],
        });

        let item_size = document.querySelector('span[data-constructor-size-id]');

        sliderH.noUiSlider.on('update', function (values, handle, unencoded) {
            let item_size_height = document.getElementById("constructor_height");
            let item_size_height_val = document.getElementById("constructor_height_val");
            item_size_height.innerHTML = Math.trunc(values[handle]);
            item_size_height_val.innerHTML = `${Math.trunc(values[handle])} см`;
            item_size.setAttribute("data-constructor-size-height", values[handle]);
            getConstructorPriceAjax();
        });
        sliderW.noUiSlider.on('update', function (values, handle, unencoded) {
            let item_size_width = document.getElementById("constructor_width");
            let item_size_width_val = document.getElementById("constructor_width_val");
            item_size_width.innerHTML = Math.trunc(values[handle]);
            item_size_width_val.innerHTML = `${Math.trunc(values[handle])} см`;
            item_size.setAttribute("data-constructor-size-width", values[handle]);
            getConstructorPriceAjax();
        });
        sliderG.noUiSlider.on('update', function (values, handle, unencoded) {
            let item_size_depth = document.getElementById("constructor_depth");
            let item_size_depth_val = document.getElementById("constructor_depth_val");
            item_size_depth.innerHTML = Math.trunc(values[handle]);
            item_size_depth_val.innerHTML = `${Math.trunc(values[handle])} см`;
            item_size.setAttribute("data-constructor-size-depth", values[handle]);
            getConstructorPriceAjax();
        });
    }



}
