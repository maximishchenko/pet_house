//import { auto } from '@popperjs/core';
import Swiper, { Navigation, Pagination, Scrollbar, Autoplay } from 'swiper';
Swiper.use([Navigation, Pagination, Scrollbar, Autoplay]);


// Главный слайдер
const heroSlider = new Swiper('.hero-slider', {
  slidesPerView: "auto",
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 3000,
  },
});

// Слайдер аксесуаров в карточке товара
const addAccessories = new Swiper('.add-accessories__swiper', {
  slidesPerView: 'auto',
  freeMode: true,
  navigation: {
    nextEl: ".add-accessories__btn-next",
    prevEl: ".add-accessories__btn-prev",
  }
});


// слайдер хиты
const thumbsSlider = new Swiper('.prod-slider', {
  slidesPerView: 1.1,
  spaceBetween: 20,

  navigation: {
    nextEl: ".thumb-slider-button-next",
    prevEl: ".thumb-slider-button-prev",
  },

  breakpoints: {
    1024: {
      slidesPerView: 3.1,
    },
  }
});

const photoGallary = new Swiper('.gallary-photo__swiper', {
  slidesPerView: 'auto',
  freeMode: true,
  navigation: {
    nextEl: ".gallary-photo-button-next",
    prevEl: ".gallary-photo-button-prev",
  },
  scrollbar: {
    el: '.gallary-photo-scrollbar'
  }
});


// медиа отзывы
const mediaReviews = new Swiper('.reviews-slider', {
  slidesPerView: "auto",
  freeMode: true,
  slideToClickedSlide: true,
  loop: true,
  centeredSlides: true,

  navigation: {
    nextEl: ".media__reviews-next",
    prevEl: ".media__reviews-prev",
  },

  pagination: {
    el: '.swiper-pagination',
  },
});

function showProductCardSwiper() {
  const productGallary = new Swiper('.product-gallary__swiper', {
    loop: true,
    pagination: {
      el: ".product-gallary--pag",
    }
  });
}


function adaptSwiper() {

  if (document.querySelector('.product-gallary__swiper') != null) {
    const productGallary = new Swiper('.product-gallary__swiper', {
      loop: true,
      pagination: {
        el: ".product-gallary--pag",
      }
    });


    if (screen.width >= 768) {

      productGallary.destroy(true, true);

    }
  }

}

addEventListener("resize", () => {
  adaptSwiper();

});

document.addEventListener("DOMContentLoaded", () => {
  adaptSwiper();
});

const catalogCat = new Swiper('.catalog-cat', {
  slidesPerView: 'auto',

  navigation: {
    nextEl: ".catalog-cat__btn-next",
    prevEl: ".catalog-cat__btn-prev",
  },

  scrollbar: {
    el: '.swiper-scrollbar'
  }

});

const catalogBar = new Swiper('.catalog-bar__btn-wrapper', {
  slidesPerView: 'auto',
  freeMode: true,
});

const popCatSlider = new Swiper('.pop-categories__slider', {
  slidesPerView: 'auto',
  freeMode: true,
});

/*   const productGallary = new Swiper('.product-gallary__swiper', {
    loop: true,
    pagination: {
      el: ".product-gallary--pag",
    }} */
