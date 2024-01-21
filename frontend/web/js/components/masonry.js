const rewGrid = document.querySelector('.grid-masonry');

if (rewGrid !== null) {

  let masonry = new GridMasonry({
    containerClass: '.grid-masonry',//Контейнер для элементов сетки
    itemClass: '.grid-item',//Каждый элемент сетки
    itemContentClass: '.grid-masonry-item__container', //Контейнер внутри каждого элемента стеки
    gridRowGap: '1.084rem',  //Верхний и нижний отступ
    gridColumnGap: '2.5rem',  //Правый и левый отступ
    itemMinWith: '15rem', //Минимальная ширина одного элемента сетки
    itemMaxWith: '1fr'    //Максимальная ширина одного элемента сетки, для работы адаптива нужно значение в единицах изменения fr
  });

  masonry.init();

  if (document.querySelector('.product-reviews')) {
    const revBtn = document.querySelector('.product-reviews__btn');
    const csrfToken = revBtn.getAttribute('data-csrf-token');
    let page = Number(revBtn.getAttribute('data-page'));
    const maxPage = Number(revBtn.getAttribute('data-page-count'));
    const grid = document.querySelector('.grid-masonry');


    async function loadRev() {
      if (page != maxPage && page < maxPage) {
        page = page + 1;
        const res = await fetch('/catalog/default/get-reviews', {
          method: 'POST',
          body: `page=${page}&_csrf-frontend=${csrfToken}`,
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content,
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        const data = await res.json();
        grid.insertAdjacentHTML('beforeend', data.content);

        masonry.init();
        if (page == maxPage) {
          revBtn.disabled = true;
        }
      }

    }
    revBtn.addEventListener('click', () => {
      loadRev();
    });
  }

}
