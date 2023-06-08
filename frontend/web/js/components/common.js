"use strict";

const mobBtnCatalog = document.getElementById('btn-catalog'),
  mobCatalog = document.querySelector('.mob-catalog'),
  mobBtncClose = document.querySelector('.mob-catalog__close');


const setListener = (element, type, handler) => {
  if (element == null) {
    return;
  } else {
    element.addEventListener(type, handler);
    return () => {
      element.removeEventListener(type, handler);
    }
  }
}

setListener(mobBtnCatalog, 'click', () => {
  mobCatalog.classList.toggle('mob-catalog--active');
  mobBtnCatalog.classList.toggle('mob-bar__el--active');
  document.querySelector('html').classList.toggle('no-scroll');
});

setListener(mobBtncClose, 'click', () => {
  mobCatalog.classList.remove('mob-catalog--active');
  mobBtnCatalog.classList.remove('mob-bar__el--active');
  document.querySelector('html').classList.remove('no-scroll');
});

const burgerBtn = document.querySelector('.burger-btn'),
      mobWrapper = document.querySelector('.mob-wrapper');

setListener(burgerBtn, 'click', () => {
  mobCatalog.classList.remove('mob-catalog--active');
  mobWrapper.classList.toggle('mob-wrapper--active');
  document.querySelector('html').classList.toggle('no-scroll');

});



document.addEventListener('DOMContentLoaded', () => { // DOM готов к взаимодейтсвию

  const onScrollHeader = () => { // объявляем основную функцию onScrollHeader

    const header = document.querySelector('.header') // находим header и записываем в константу

    let prevScroll = window.pageYOffset // узнаем на сколько была прокручена страница ранее
    let currentScroll // на сколько прокручена страница сейчас (пока нет значения)

    window.addEventListener('scroll', () => { // при прокрутке страницы

      currentScroll = window.pageYOffset // узнаем на сколько прокрутили страницу

      const headerHidden = () => header.classList.contains('header_hidden') // узнаем скрыт header или нет

      if (currentScroll > prevScroll && !headerHidden()) { // если прокручиваем страницу вниз и header не скрыт
        header.classList.add('header_hidden') // то скрываем header
      }
      if (currentScroll < prevScroll && headerHidden()) { // если прокручиваем страницу вверх и header скрыт
        header.classList.remove('header_hidden') // то отображаем header
      }

      prevScroll = currentScroll // записываем на сколько прокручена страница на данный момент

    })

  }

  onScrollHeader() // вызываем основную функцию onScrollHeader

});

// Вопросы и ответы
document.querySelectorAll('.q-btn')
  .forEach(el => el.addEventListener('click', function (e) {
    let activElement = el.parentElement.closest('.q-el');
    activElement.classList.toggle('q-el--active');
  }));
