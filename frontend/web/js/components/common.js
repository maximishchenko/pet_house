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

      if (currentScroll > prevScroll + 50 && !headerHidden()) { // если прокручиваем страницу вниз и header не скрыт
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


// ticker
import Reeller from 'reeller';
import gsap from 'gsap';
Reeller.registerGSAP(gsap);

if (document.querySelector('.tiker') != null) {
  const reellerF = new Reeller({
    container: '.tiker--f',
    wrapper: '.tiker__wrapper--f',
    itemSelector: '.tiker__item--f',
    speed: 50,
  });

  const reellerS = new Reeller({
    container: '.tiker--s',
    wrapper: '.tiker__wrapper--s',
    itemSelector: '.tiker__item--s',
    speed: 50,
    reversed: true,
  });
}


if (document.querySelector('.scroll-wrapper') != null) {

  const scrollDiv = document.querySelector('.scroll-wrapper');

  scrollDiv.addEventListener('scroll', function () {
    const touchIc = document.querySelector('.touch_ic');
    if (touchIc.style.display != 'none') {
      touchIc.style.display = 'none';
    }
  });

}

// Кнопка неверх
let scrollToTop = document.querySelector(".footer__up");
scrollToTop.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
  return false;
});

function throttle(callee, timeout) {
  let timer = null

  return function perform(...args) {
    if (timer) return

    timer = setTimeout(() => {
      callee(...args)

      clearTimeout(timer)
      timer = null
    }, timeout)
  }
}

function updateCatalog() {
  const catalogList = document.querySelector('.catalog__list');
  const screenHeight = window.innerHeight;
  let catalogListOffset = catalogList.offsetTop,
    catalogListHeight = catalogList.clientHeight,
    scrolledOffset = catalogListHeight + catalogListOffset,
    scrolled = window.scrollY,
    showMore = document.querySelector("#showMore"),
    pageNumber = showMore.getAttribute('data-page'),
    totalPages = showMore.getAttribute('data-page-count'),
    csrfToken = showMore.getAttribute('data-csrf-token'),
    page = parseInt(pageNumber),
    pageCount = parseInt(totalPages);

  if (scrolledOffset <= scrolled + screenHeight && page <= pageCount) {

    fetch(window.location.href, {
      method: 'POST',
      body: `page=${page + 1}&_csrf-frontend=${csrfToken}`,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then((response) => response.text())
      .then((data) => {
        let next_page = page + 1
        showMore.setAttribute('data-page', next_page);
        catalogList.insertAdjacentHTML('beforeend', data);
      })
  }
}

window.addEventListener('scroll', throttle(updateCatalog, 550));
