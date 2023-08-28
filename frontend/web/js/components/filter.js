
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

let filterSubmit = document.querySelectorAll(".filter__submit");
filterSubmit.forEach(element => {
    element.addEventListener('change', function() {
        // element.closest( 'form' ).submit();
    });
});