if (document.querySelector('.catalog-cat')) {

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
      });



      const updateInfo = document.querySelector('#showMore');
      const csrfToken = updateInfo.getAttribute('data-csrf-token');

      // Подгрузка товара
      const catalogSpinner = document.querySelector('.spinner-container');
      const lastCard = catalogList.querySelector('[data-key]:last-child');
      const filterForm = document.querySelector('#catalog_search');

      const catalogObserver = new IntersectionObserver((entries) => {
            entries.forEach(el => {
                  if (el.isIntersecting) {
                        updateCatalog();
                        catalogObserver.unobserve(el.target)
                  }
            })
      });

      catalogObserver.observe(lastCard);

      function catalogUrlParams() {
            let data = new FormData(filterForm);
            let params = new URLSearchParams(data);
            let formatParams = params.toString();

            return formatParams
      }


      function updateCatalog() {
            console.log('dawd');

            let pageNumber = parseInt(updateInfo.getAttribute('data-page'));
            let totalPages = parseInt(updateInfo.getAttribute('data-page-count'));

            if (pageNumber != totalPages) {

                  catalogSpinner.classList.add('spinner-container--show');

                  fetch(`${window.location.pathname}?${catalogUrlParams()}`, {
                        method: 'POST',
                        body: `page=${pageNumber + 1}&_csrf-frontend=${csrfToken}`,
                        headers: {
                              'Content-Type': 'application/x-www-form-urlencoded',
                              'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
                              'X-Requested-With': 'XMLHttpRequest'
                        }
                  })
                        .then((response) => {
                              if (!response.ok) {
                                    location.reload();
                              }
                              return response.json();
                        })
                        .then((data) => {
                              pageNumber++
                              updateInfo.setAttribute('data-page', pageNumber);
                              catalogList.insertAdjacentHTML('beforeend', data.content);
                              catalogObserver.observe(catalogList.querySelector('[data-key]:last-child'));
                              catalogSpinner.classList.remove('spinner-container--show');
                        });
            }

      }

      // Фильтр
      const searchBtn = document.querySelector('#catalog__searh-btn');
      const searchFormIntp = document.querySelectorAll('#catalog_search input');

      function catalogSearchSend() {
            catalogObserver.disconnect()
            fetch(`${window.location.pathname}?${catalogUrlParams()}`, {
                  headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
                        'X-Requested-With': 'XMLHttpRequest'
                  }
            })
                  .then((response) => {
                        if (!response.ok) {
                              location.reload();
                        }
                        return response.json();
                  })
                  .then((data) => {
                        catalogList.innerHTML = data.content;
                        updateInfo.setAttribute('data-page', 1);
                        updateInfo.setAttribute('data-page-count', data.pagesCount);
                        catalogObserver.observe(catalogList.querySelector('[data-key]:last-child'));
                  });

            let url = window.location.origin + window.location.pathname
            let searchUrl = url + "?" + catalogUrlParams();
            history.replaceState("", "", searchUrl);
      }

      searchBtn.addEventListener('click', (e) => {
            e.preventDefault();
            catalogSearchSend();
      });

      searchFormIntp.forEach(el => {
            el.addEventListener('change', catalogSearchSend);
      });

      // Сортировка 
      const sortOpenBtn = document.querySelector('.catalog-bar__sort-title');
      sortWrapper = document.querySelector('.catalog-bar__sort-wrapper'),
            sortItemBtn = document.querySelectorAll('.catalog-bar__sort-item'),
            sortBtnText = document.querySelector('.catalog-bar__sort-title--select'),
            sortWrapper = document.querySelector('.catalog-bar__sort-wrapper'),
            sortInp = document.querySelector('.sort-inp');

      function showSort() {
            sortWrapper.classList.toggle('catalog-bar__sort-wrapper--active');
      }

      sortOpenBtn.addEventListener('click', showSort);

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
                  catalogSearchSend();
            });
      });


}


