
if (document.querySelector('.catalog-cat')) {

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
        });
    });

    // Загрузка товара
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

    const catalogSpiner = document.querySelector('.spinner-container'),
        updateInfo = document.querySelector('#showMore');

    let updateCatalogCounter = 0,
        pageNumber = parseInt(updateInfo.getAttribute('data-page')),
        totalPages = parseInt(updateInfo.getAttribute('data-page-count')),
        csrfToken = updateInfo.getAttribute('data-csrf-token');

    function hideSpiner() {
        if (pageNumber == totalPages) {
            catalogSpiner.classList.add('spinner-container--hide');
        }
    }

    hideSpiner();

    function updateCatalog() {

        const catalogList = document.querySelector('.catalog__list'),
            screenHeight = window.innerHeight;

        let catalogListOffset = catalogList.offsetTop,
            catalogListHeight = catalogList.clientHeight,
            scrolledOffset = catalogListHeight + catalogListOffset - 500,
            scrolled = window.scrollY;

        if (scrolledOffset <= scrolled + screenHeight && totalPages > pageNumber && updateCatalogCounter == 0) {

            updateCatalogCounter++

            fetch(window.location.pathname, {
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
                    return response.text()
                })
                .then((data) => {
                    catalogSpiner.classList.remove('spinner-container--show');
                    updateCatalogCounter = 0;
                    pageNumber++;
                    showMore.setAttribute('data-page', pageNumber);
                    catalogList.insertAdjacentHTML('beforeend', data);
                    hideSpiner();
                });
        }
    }
    window.addEventListener('scroll', throttle(updateCatalog, 2000));
}

