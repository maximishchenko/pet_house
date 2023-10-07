
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
            catalogSearchSend();
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

        csrfToken = updateInfo.getAttribute('data-csrf-token');

    function hideSpiner() {
        let pageNumber = parseInt(updateInfo.getAttribute('data-page')),
            totalPages = parseInt(updateInfo.getAttribute('data-page-count'));

        if (pageNumber == totalPages) {
            catalogSpiner.classList.add('spinner-container--hide');
        }
    }

    hideSpiner();

    function updateCatalog() {

        let data = new FormData(searchForm);
        let params = new URLSearchParams(data);
        let formatParams = params.toString();

        let url = window.location.origin + window.location.pathname
        let searchUrl = url + "?" + formatParams;

        let pageNumber = parseInt(updateInfo.getAttribute('data-page')),
            totalPages = parseInt(updateInfo.getAttribute('data-page-count'));

        const catalogList = document.querySelector('.catalog__list'),
            screenHeight = window.innerHeight;

        let catalogListOffset = catalogList.offsetTop,
            catalogListHeight = catalogList.clientHeight,
            scrolledOffset = catalogListHeight + catalogListOffset - 500,
            scrolled = window.scrollY;

        if (scrolledOffset <= scrolled + screenHeight && totalPages > pageNumber && updateCatalogCounter == 0) {

            updateCatalogCounter++

            fetch(searchUrl, {
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
                    updateCatalogCounter = 0;
                    pageNumber++;
                    showMore.setAttribute('data-page', pageNumber);
                    catalogList.insertAdjacentHTML('beforeend', data.content);
                    hideSpiner();
                });
        }
    }
    window.addEventListener('scroll', throttle(updateCatalog, 2000));

    const searchForm = document.querySelector('#catalog_search');
    const searchBtn = document.querySelector('#catalog__searh-btn');
    const searchFormIntp = document.querySelectorAll('#catalog_search input');
    const catalogList = document.querySelector('.catalog__list');

    function catalogSearchSend() {
        let data = new FormData(searchForm);
        let params = new URLSearchParams(data);
        let formatParams = params.toString();

        fetch(`${window.location.pathname}?${formatParams}`, {
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
                let pageCount = Math.floor(data.totalCount / 6 + 1);
                updateInfo.setAttribute('data-page', 1);
                updateInfo.setAttribute('data-page-count', pageCount);
            });

        let url = window.location.origin + window.location.pathname
        let searchUrl = url + "?" + formatParams;
        history.replaceState("", "", searchUrl);
    }

    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        catalogSearchSend();
    });

    searchFormIntp.forEach(el => {
        el.addEventListener('change', catalogSearchSend);
    });
}  