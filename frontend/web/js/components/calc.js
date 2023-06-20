import FloatSidebar from 'float-sidebar';

document.addEventListener("DOMContentLoaded", () => {

  const sidebar = document.querySelector('.sidebar');
  const relative = document.querySelector('.product__col');

  if (relative != null) {
    const floatSidebar = FloatSidebar({
      sidebar,
      relative,
      topSpacing: 140,
      bottomSpacing: 140
    });

    const gallary = document.querySelector('.product-gallary');
    const mobWrapper = document.querySelector('.gallery-mob');
    const gallaryWrapper = document.querySelector('.product__col');

    const calc = document.querySelector('.sidebar-adapt');
    const calcMobWrapper = document.querySelector('.product__optional');
    const calcBackWrapper = document.querySelector('.sidebar__inner');


    function adapt() {


      if (screen.width < 768) {

        mobWrapper.appendChild(gallary);
        calcMobWrapper.appendChild(calc);
        calcMobWrapper.prepend(calc);

        console.log('mob')
        19
      } else if (mobWrapper.querySelector('.product-gallary')) {
        gallaryWrapper.appendChild(gallary);
        gallaryWrapper.prepend(gallary);
        calcBackWrapper.appendChild(calc);
        floatSidebar.forceUpdate();

        console.log('desk')
      }
    }

    addEventListener("resize", () => {
      adapt();
    });

    adapt();

    document.querySelectorAll('.calc-el__btn-control')
      .forEach(el => el.addEventListener('click', function (e) {
        let activElement = el.parentElement.closest('.calc-el');
        activElement.classList.toggle('calc-el--active');
      }));

  }
});

