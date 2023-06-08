// Замена заголовка в конструкторе
function setConstructorColor(color)
{
    let color_name = color.getAttribute('data-color-name');
    let color_image = color.getAttribute('data-color-image');
    
    let item_color_name = document.querySelector('span[data-constructor-color-name]');
    let item_color_image = document.querySelector('span[data-constructor-color-image]');
    item_color_name.innerHTML = color_name;
    item_color_image.style.backgroundImage = "url(" + color_image + ")";
}

// 
function setConstructorSize(size)
{
    let size_height = size.getAttribute("data-size-height");
    let size_width = size.getAttribute("data-size-width");
    let size_depth = size.getAttribute("data-size-depth");

    let item_size_height = document.getElementById("constructor_height");
    let item_size_width = document.getElementById("constructor_width");
    let item_size_depth = document.getElementById("constructor_depth");

    item_size_height.innerHTML = size_height;
    item_size_width.innerHTML = size_width;
    item_size_depth.innerHTML = size_depth;
}

function setConstructorWall(wall)
{
    let wall_name = wall.getAttribute("data-wall-name");

    let item_wall = document.querySelector('span[data-constructor-wall-name]');
    item_wall.innerHTML = wall_name;
}