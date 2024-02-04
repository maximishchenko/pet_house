import Inputmask from "inputmask";
import JustValidate from 'just-validate';

const order_form = document.querySelector('.order-form--cart');
if (order_form) {

      // function test() {
      //       const btn = document.querySelector('.order-form__send');
      //       btn.textContent = 'daw';
      //       /*             let count = 0;
      //                   if (count == 0) {
      //                         order_form.submit();
      //                         count = 1;
      //                   } */

      // }

      const phoneInp = document.querySelector('.phone-valid');
      const phoneMask = new Inputmask('+9 (999) 999-99-99');
      phoneMask.mask(phoneInp);

      const validator = new JustValidate(document.querySelector('.order-form--cart'), { submitFormAutomatically: true, });

      validator.addField('#order-name', [
            {
                  rule: 'required',
                  errorMessage: 'Пожалуйста, укажите Ф.И.О'
            },
            {
                  rule: 'minLength',
                  value: 3,
                  errorMessage: 'Минимальное количество символов: 3'
            },
            {
                  rule: 'maxLength',
                  value: 30,
                  errorMessage: 'Максимальное количество символов: 30'
            }
      ]).addField('#order-phone', [
            {
                  rule: 'required',
                  errorMessage: 'Пожалуйста, укажите Ваш номер телефона',
            },
            {
                  validator: (vale) => {
                        const phone = phoneInp.inputmask.unmaskedvalue();
                        return phone.length === 11;
                  },
                  errorMessage: 'Пожалуйста, укажите корректный номер телефона',
            }
      ]).addField('#order-email', [
            {
                  rule: 'email',
                  errorMessage: 'Некорректный формат email'
            }
      ])
      // .onSuccess((event) => {
      //       test()
      // });

      // order_form.addEventListener('submit', function (e) {
      //       console.log('ad');

      //       order_form.stopPropagation();
      //       order_form.preventDefault();
      // });

}
