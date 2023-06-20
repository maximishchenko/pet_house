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

const filterBtn = document.querySelector('.catalog-bar__btn--filter');
const catalogSide = document.querySelector('.catalog__side');
const catalogList = document.querySelector('.catalog__list');
const btnMobCloase = document.querySelector('.filter-mob_cloase');


setListener(filterBtn, 'click', () => {
  catalogSide.classList.toggle('catalog__side--active');
  catalogList.classList.toggle('catalog__list--active');
  filterBtn.classList.toggle('filter-show');
});

setListener(btnMobCloase, 'click', () => {
  catalogSide.classList.toggle('catalog__side--active');
  catalogList.classList.toggle('catalog__list--active');
  filterBtn.classList.toggle('filter-show');
});

if (screen.width < 768) {
  setListener(filterBtn, 'click', () => {
    document.querySelector('html').classList.toggle('no-scroll');
  });

  setListener(btnMobCloase, 'click', () => {
    document.querySelector('html').classList.toggle('no-scroll');
  });


  window.addEventListener('click', e => {
    let target = e.target

    const sortBtn = document.querySelector('.catalog-bar__sort-title--select');
    const sortWrapper = document.querySelector('.catalog-bar__sort-wrapper')


    if (target != sortBtn) {
      sortWrapper.classList.remove('catalog-bar__sort-wrapper--active');
    } else {
      sortWrapper.classList.add('catalog-bar__sort-wrapper--active');
    }

  });
}
