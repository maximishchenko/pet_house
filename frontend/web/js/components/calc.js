import FloatSidebar from 'float-sidebar';

const sidebar = document.querySelector('.sidebar');
const relative = document.querySelector('.product__col');

if (sidebar !== null) {
  const floatSidebar = FloatSidebar({
    sidebar,
    relative,
    topSpacing: 40,
    bottomSpacing: 20
  });
}



document.querySelectorAll('.calc-el__btn-control')
  .forEach(el => el.addEventListener('click', function (e) {
    let activElement = el.parentElement.closest('.calc-el');
    activElement.classList.toggle('calc-el--active');
  }));

