//import { auto } from '@popperjs/core';
import Swiper, { Navigation, Pagination, Scrollbar, Autoplay } from 'swiper';
Swiper.use([Navigation, Pagination, Scrollbar, Autoplay]);


// Слайдер аксесуаров в карточке товара
const addAccessories = new Swiper('.add-accessories__swiper', {
  slidesPerView: 'auto',
  loop: 'true',
  freeMode: true,
});


// слайдер хиты на главной
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
