if (document.querySelector('.catalog-bar__btn--filter')) {

  const filterBtn = document.querySelector('.catalog-bar__btn--filter'),
    catalogSide = document.querySelector('.catalog__side'),
    catalogList = document.querySelector('.catalog__list'),
    btnMobCloase = document.querySelector('.filter-mob_cloase');

  function showFilter() {
    catalogSide.classList.toggle('catalog__side--active');
    catalogList.classList.toggle('catalog__list--active');

    if (screen.width > 761) {
      filterBtn.classList.toggle('filter-show');
    }
  }

  filterBtn.addEventListener('click', () => {
    showFilter();
  });

  btnMobCloase.addEventListener('click', () => {
    showFilter();
  })

  const sortItemBtn = document.querySelectorAll('.catalog-bar__sort-item'),
    sortBtn = document.querySelector('.catalog-bar__sort-title'),
    sortBtnText = document.querySelector('.catalog-bar__sort-title--select'),
    sortWrapper = document.querySelector('.catalog-bar__sort-wrapper'),
    sortInp = document.querySelector('.sort-inp');

  function showSort() {
    sortWrapper.classList.toggle('catalog-bar__sort-wrapper--active');
  }

  sortItemBtn.forEach(el => {
    el.addEventListener('click', () => {
      let btnText = el.textContent;

      sortBtnText.textContent = btnText;
      sortInp.value = el.getAttribute('data-sort-param');
      
    
      sortItemBtn.forEach(el => {
        el.classList.remove('catalog-bar__sort-item--active');
      });

      el.classList.add('catalog-bar__sort-item--active');

      showSort();
    });
  });

  sortBtn.addEventListener('click', () => {
    showSort();
  });
}


