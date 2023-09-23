
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

const catalogForm = document.querySelector('#catalog_search');
const catalogFormInputs = document.querySelectorAll('#catalog_search input');

function handleFormSubmit(event) {
  event.preventDefault()

  let formData = new FormData(catalogForm);
  let formDataString = new URLSearchParams(formData).toString();

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

catalogForm?.addEventListener('submit', () => {
  handleFormSubmit();
})

catalogFormInputs?.forEach(item => {
  item.addEventListener('change', handleFormSubmit);

})



/* $('#catalog_search').on('beforeSubmit', function (e) {
  alert('before submit');
}).on('submit', function (e) {
  e.preventDefault();
  var form = $(this);
  var formData = form.serialize();
  console.log(formData)
  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: formData,
    beforeSend: function () {
    },
    complete: function (data) {
      console.log(data)
      $('.catalog__list').html(data.responseText);
      var url = window.location.origin + window.location.pathname
      var searchUrl = url + "?" + formData;
      history.replaceState("", "", searchUrl);

    },
    error: function () {
      console.log("Something went wrong");
    }
  });
}); */