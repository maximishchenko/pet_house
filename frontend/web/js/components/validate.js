import Inputmask from "inputmask";
import JustValidate from 'just-validate';

const order_form = document.querySelector('.order-form--cart');
if (order_form) {

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
      ]).onSuccess((event) => {
            event.submitter.disabled = true;
      });

}
