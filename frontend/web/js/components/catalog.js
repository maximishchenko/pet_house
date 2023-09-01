/* const filterBtn = document.querySelector('.catalog-bar__btn--filter');
const catalogSide = document.querySelector('.catalog__side');
const catalogList = document.querySelector('.catalog__list');
const btnMobCloase = document.querySelector('.filter-mob_cloase');

if (catalogList != null) {
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
}
 */


/* const filterBtn = document.querySelector('.catalog-bar__btn--filter'),
      catalogSide = document.querySelector('.catalog__side'),
      catalogList = document.querySelector('.catalog__list'),
      btnMobCloase = document.querySelector('.filter-mob_cloase');

filterBtn.addEventListener('click', () => {
      catalogSide.classList.toggle('catalog__side--active');
      catalogList.classList.toggle('catalog__list--active');
      filterBtn.classList.toggle('filter-show');

      if (screen.width < 768) {
            setListener(filterBtn, 'click', () => {
                  document.querySelector('html').classList.toggle('no-scroll');
            });

            setListener(btnMobCloase, 'click', () => {
                  document.querySelector('html').classList.toggle('no-scroll');
            });
      }
});

btnMobCloase.addEventListener('click', () => {
      
}); */

const sortItemBtn = document.querySelectorAll('.catalog-bar__sort-item'),
  sortBtn = document.querySelector('.catalog-bar__sort-title--select'),
  sortWrapper = document.querySelector('.catalog-bar__sort-wrapper'),
  sortInp = document.querySelector('.sort-inp');

function showSort() {
  sortWrapper.classList.toggle('catalog-bar__sort-wrapper--active');
}

sortItemBtn.forEach(el => {
  el.addEventListener('click', () => {
    let btnText = el.textContent;

    sortBtn.textContent = btnText;
    sortInp.value = btnText;

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

