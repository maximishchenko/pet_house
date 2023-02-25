<?php

use common\models\Status;
use common\models\Sort;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\items\ProductItemType;

$attributes = [];

# Характеристики
## Витрины для грызунов
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'1'] = [
    'id' => 1,
    'name' => 'Материал каркаса',
    'value' => 'Сосна',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'2'] = [
    'id' => 2,
    'name' => 'Механизм открывания ящика',
    'value' => 'Выдвижной',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'3'] = [
    'id' => 3,
    'name' => 'Высота ящика',
    'value' => '30 см',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'4'] = [
    'id' => 4,
    'name' => 'Механизм открывания ящика',
    'value' => 'Откидной',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'5'] = [
    'id' => 5,
    'name' => 'Тип окрашивания каркаса',
    'value' => 'Водная акриловая краска',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'6'] = [
    'id' => 6,
    'name' => 'Боковые сетки',
    'value' => 'Оцинкованные',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'7'] = [
    'id' => 7,
    'name' => 'Толщина стекла',
    'value' => '4 мм',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'8'] = [
    'id' => 8,
    'name' => 'Материал наполнения',
    'value' => 'Березовая фанера',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'9'] = [
    'id' => 9,
    'name' => 'Вариант доставки',
    'value' => 'В собранном виде',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'10'] = [
    'id' => 10,
    'name' => 'Механизм открывания лотка',
    'value' => 'Выдвижной',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'11'] = [
    'id' => 11,
    'name' => 'Высота ящика',
    'value' => '10 см',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];

## Вольеры для собак
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'12'] = [
    'id' => 12,
    'name' => 'Материал каркаса',
    'value' => 'Сосна',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];
$attributes[CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE.'13'] = [
    'id' => 13,
    'name' => 'Вариант доставки',
    'value' => 'В собранном виде',
    'sort' => Sort::DEFAULT_SORT_VALUE,
    'status' => Status::STATUS_ACTIVE,
    'product_type' => CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE,
    'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
    'created_at' => time(),
    'updated_at' => time(),
];


return $attributes;