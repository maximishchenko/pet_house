//import { auto } from '@popperjs/core';
import Swiper, { Navigation, Pagination, Scrollbar, Autoplay } from 'swiper';
Swiper.use([Navigation, Pagination, Scrollbar, Autoplay]);


// Главный слайдер
const heroSlider = new Swiper('.hero-slider', {
  slidesPerView: "auto",
  spaceBetween: 20,
  loop: true,
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
  freeMode: true,
  slideToClickedSlide: true,

  navigation: {
    nextEl: ".thumb-slider-button-next",
    prevEl: ".thumb-slider-button-prev",
  },

  breakpoints: {
    1024: {
      slidesPerView: 4.3,
    },
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

import { isMobile, isTablet, isDesktop } from '../functions/check-viewport';
if (isMobile()) {

  const productGallary = new Swiper('.product-gallary__swiper', {
    slidesPerView: "auto",
    spaceBetween: 20,
    loop: true,
  });

}


// Популярные категории
/* const populars = new Swiper('.pop-categories__slider', {
  slidesPerView: "auto",
  freeMode: true,
  centeredSlides: true,
});
 */
