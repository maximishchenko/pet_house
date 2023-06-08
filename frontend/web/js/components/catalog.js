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



const filterBtn = document.querySelector('.catalog-bar__btn--filter'),
  catalogSide = document.querySelector('.catalog__side'),
  catalogList = document.querySelector('.catalog__list');


setListener(filterBtn, 'click', () => {
  catalogSide.classList.toggle('catalog__side--active');
  catalogList.classList.toggle('catalog__list--active');
  filterBtn.classList.toggle('filter-show');
});
