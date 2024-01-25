import Masonry from "masonry-layout";

const grid = document.querySelector('.grid-masonry');

const msGrid = new Masonry(grid, {
      itemSelector: '.grid-item'
})

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

                  msGrid.reloadItems();
                  msGrid.layout();

                  if (page == maxPage) {
                        revBtn.disabled = true;
                  }
            }
      }
      revBtn.addEventListener('click', () => {
            loadRev();
           
      });
}
