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
}


