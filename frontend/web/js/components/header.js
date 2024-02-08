
const mobWrapper = document.querySelector('.mob-wrapper');
const headerNav = document.querySelector('.header-nav');
const headerPhone = document.querySelector('.header__phone');
const headerWrapper = document.querySelector('.header__wrapper');
const headerBag = document.querySelector('.header__bag');

function headerAdapt() {
    if (screen.width < 768) {
        mobWrapper.appendChild(headerNav);
        mobWrapper.appendChild(headerPhone);
    } else {
        headerWrapper.appendChild(headerNav);
        headerWrapper.appendChild(headerPhone);
        headerWrapper.appendChild(headerBag);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    headerAdapt();
});

window.addEventListener('resize', function () {
    headerAdapt();
});