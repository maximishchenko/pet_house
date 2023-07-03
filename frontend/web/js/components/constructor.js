// Замена заголовка в конструкторе
function setConstructorColor(color)
{
    let color_name = color.getAttribute('data-color-name');
    let color_image = color.getAttribute('data-color-image');
    let color_id = color.getAttribute('data-color-id');
    
    let item_color_name = document.querySelector('span[data-constructor-color-name]');
    let item_color_image = document.querySelector('span[data-constructor-color-image]');
    item_color_name.innerHTML = color_name;
    item_color_image.style.backgroundImage = "url(" + color_image + ")";
    item_color_image.setAttribute("data-constructor-color-id", color_id);

    getConstructorPriceAjax()
}

// 
function setConstructorSize(size)
{
    let size_height = size.getAttribute("data-size-height");
    let size_width = size.getAttribute("data-size-width");
    let size_depth = size.getAttribute("data-size-depth");
    let size_id = size.getAttribute('data-size-id');

    let item_size_height = document.getElementById("constructor_height");
    let item_size_width = document.getElementById("constructor_width");
    let item_size_depth = document.getElementById("constructor_depth");
    
    let item_size = document.querySelector('span[data-constructor-size-id]');

    item_size_height.innerHTML = size_height;
    item_size_width.innerHTML = size_width;
    item_size_depth.innerHTML = size_depth;

    item_size.setAttribute("data-constructor-size-id", size_id);

    getConstructorPriceAjax()
}

function setConstructorWall(wall)
{
    let wall_name = wall.getAttribute("data-wall-name");
    let wall_id = wall.getAttribute("data-wall-id");

    let item_wall = document.querySelector('span[data-constructor-wall-name]');
    let item_wall_id = document.querySelector('span[data-constructor-wall-id]');
    item_wall.innerHTML = wall_name;
    item_wall_id.setAttribute('data-constructor-wall-id', wall_id);

    getConstructorPriceAjax()
}

function getConstructorPriceAjax()
{
    let constructorProduct = document.querySelector('div[data-product-id]');
    let constructorProductId = constructorProduct.getAttribute("data-product-id");
    let constructorCsrfParam = constructorProduct.getAttribute("data-csrf-param");
    let constructorCsrfToken = constructorProduct.getAttribute("data-csrf-token");

    let constructorProductColor = document.querySelector('span[data-constructor-color-id]');
    let constructorProductColorId = constructorProductColor.getAttribute("data-constructor-color-id");

    let constructorProductSize = document.querySelector('span[data-constructor-size-id]');
    let constructorProductSizeId = constructorProductSize.getAttribute("data-constructor-size-id");

    let constructorProductWall = document.querySelector('span[data-constructor-wall-id]');
    let constructorProductWallId = constructorProductWall.getAttribute("data-constructor-wall-id");


    data = {
        'product_id': constructorProductId,
        'color': constructorProductColorId,
        'size': constructorProductSizeId,
        'walls': constructorProductWallId,
        '_csrf' : constructorCsrfToken,
    };
    $.ajax({
        url: '/catalog/default/calculate-price-constructor',
        type: 'GET',
        dataType: "json",
        data: data,
        beforeSend: function () {
        },
        complete: function (data) {
            data = JSON.parse(data.responseText);
            priceValueFormatted = data.price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            oldPriceValueFormatted = data.old_price.toLocaleString('ru-RU', { minimumFractionDigits: 0 });
            document.getElementById("constructor_price").innerHTML = priceValueFormatted;
            document.getElementById("constructor_price_old").innerHTML = oldPriceValueFormatted;
        },
        error: function () {
        }
    });

}