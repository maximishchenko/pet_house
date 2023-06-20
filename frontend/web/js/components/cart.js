
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


