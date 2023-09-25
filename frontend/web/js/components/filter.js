
let filterCategory = document.querySelectorAll(".filter__category");
filterCategory.forEach(element => {
  element.addEventListener('click', function () {

    let paramName = element.getAttribute('data-search-name');
    let paramValue = element.getAttribute('data-search-value');

    let currentUrl = window.location.href.split('?')[0];
    let urlString = new URL(currentUrl);
    urlString.searchParams.append(paramName, paramValue);
    window.location = urlString;
  })
});

if (document.querySelector('#catalog_search')) {
  function searchFormSubmit() {
    const catalogForm = document.querySelector('#catalog_search');
    const queryString = new URLSearchParams(new FormData(catalogForm)).toString();
    let searchUrlAction = `${catalogForm.action}?${queryString}`;

    fetch(searchUrlAction, {
      method: catalogForm.method,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
        'X-Requested-With': 'XMLHttpRequest'
      },
    }).then((response) => response.text())
      .then((data) => {
        document.querySelector('.catalog__list').innerHTML = data;
      });

    let url = window.location.origin + window.location.pathname
    let searchUrl = url + "?" + formDataString;
    history.replaceState("", "", searchUrl);
  }

  const catalogFormInputs = document.querySelectorAll('#catalog_search input');

  catalogFormInputs.forEach(el => {
    el.addEventListener('change', searchFormSubmit);
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
      searchFormSubmit();
    });
  });

  sortBtn.addEventListener('click', () => {
    showSort();
  });
}
