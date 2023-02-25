// Вопросы и ответы
document.querySelectorAll('.q-btn')
  .forEach(el => el.addEventListener('click', function (e) {
    let activElement = el.parentElement.closest('.q-el');
    activElement.classList.toggle('q-el--active');
  }));
