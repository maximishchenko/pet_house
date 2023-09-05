
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

const addToCartBtn = document.querySelector('.product__action-btn');
const cartSidebar = document.querySelector('.cart-sidebar');
const cartSidebarBg = document.querySelector('.cart-sidebar__bg');
const cartSidebarBtnCloase = document.querySelector('.cart-sidebar__btn-close');

function sideBarToggle() {
    cartSidebar.classList.toggle('cart-sidebar--active');
    document.querySelector('.page').classList.toggle('dis-scroll')
}

addToCartBtn.addEventListener('click', () => {
    sideBarToggle();
})

cartSidebarBg.addEventListener('click', () => {
    sideBarToggle();
})

cartSidebarBtnCloase.addEventListener('click', () => {
    sideBarToggle();
})


const counterVal = document.querySelector('.counter__val');
const counterDec = document.querySelector('.counter__btn-min');
const counterInc = document.querySelector('.counter__btn-plus');

let cartCounter = 1;

counterInc.addEventListener('click', () => {
    if (cartCounter < 50) {
        cartCounter++
        counterVal.innerHTML = cartCounter
    }
})

counterDec.addEventListener('click', () => {
    if (cartCounter > 1) {
        cartCounter--
        counterVal.innerHTML = cartCounter
    }
})

