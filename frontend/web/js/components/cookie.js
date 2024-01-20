const cookieEl = document.querySelector('.cookie_notice');
const okEl = document.querySelector('.cookie-modal__btn');

okEl.addEventListener('click', () => {
      cookieEl.classList.add("cookie-modal--hide");
});

let cookies = () => {
  if (!Cookies.get('r-cookie')) {
    setTimeout(() => {
      cookieEl.classList.remove("cookie-modal--hide");
    }, 1000);
  }

  Cookies.set('r-cookie', 'true', {
    expires: 30
  });
}


cookies();