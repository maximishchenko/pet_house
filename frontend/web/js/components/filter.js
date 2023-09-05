
let filterCategory = document.querySelectorAll(".filter__category");
filterCategory.forEach(element => {
    element.addEventListener('click', function() {

        let paramName = element.getAttribute('data-search-name');
        let paramValue = element.getAttribute('data-search-value');

        let currentUrl = window.location.href.split('?')[0];
        let urlString = new URL(currentUrl);
        urlString.searchParams.append(paramName, paramValue);
        window.location = urlString;
    })
});

// Catalog Ajax Search
// let filterSubmit = document.querySelectorAll(".filter__submit");
// filterSubmit.forEach(element => {
//     element.addEventListener('change', function() {
//         element.closest( 'form' ).submit();
//     });
// });
$('#catalog_search input').on('change', function () {
  $('#catalog_search').submit();
});

$('#catalog_search').on('beforeSubmit', function (e) {
    alert('before submit');
  }).on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: formData,
      beforeSend: function () {
      },
      complete: function (data) {
  
        $('.catalog__list').html(data.responseText);
        var url = window.location.origin + window.location.pathname
        var searchUrl = url + "?" + formData;
        history.replaceState("", "", searchUrl);
  
      },
      error: function () {
        console.log("Something went wrong");
      }
    });
  });