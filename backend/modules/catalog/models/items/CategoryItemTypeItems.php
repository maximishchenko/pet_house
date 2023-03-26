<?php

namespace backend\modules\catalog\models\items;

use Yii;

class CategoryItemTypeItems
{
    
    /**
     * Массив соответствий возможных значений item_type дочерним классам
     *
     * @return array
     */
    public static function getItemTypeChilds(): array
    {
        return [
            'backend\modules\catalog\models\abstracts\ProductCategory' => ProductItemType::PRODUCT_TYPE_PRODUCT,
        ];
    }
}