
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

    function updateCatalog() {
        const catalogList = document.querySelector('.catalog__list');
        const screenHeight = window.innerHeight;
        const catalogSpiner = document.querySelector('.spinner-container');

        let catalogListOffset = catalogList.offsetTop;
        let catalogListHeight = catalogList.clientHeight;
        let scrolledOffset = catalogListHeight + catalogListOffset;
        let scrolled = window.scrollY;

        const updateInfo = document.querySelector('#showMore');

        let pageNumber = parseInt(updateInfo.getAttribute('data-page'));
        let totalPages = parseInt(updateInfo.getAttribute('data-page-count'));
        let csrfToken = updateInfo.getAttribute('data-csrf-token');

        if (scrolledOffset <= scrolled + screenHeight && totalPages > pageNumber) {
            catalogSpiner.classList.add('spinner-container--show');  

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
                    pageNumber++
                    showMore.setAttribute('data-page', pageNumber);
                    catalogList.insertAdjacentHTML('beforeend', data);
                })
        }

    }

    window.addEventListener('scroll', throttle(updateCatalog, 1550));




}

