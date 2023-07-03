<?php

namespace backend\modules\catalog\models\items;

use Yii;

class ProductItemType
{
    /**
     * Тип - продукт
     */
    const PRODUCT_TYPE_PRODUCT = 'product';

    /**
     * Тип - аксессуар
     */
    const PRODUCT_TYPE_ACCESSORY = 'accessory';

    /**
     * Возвращает массив допустимых типов ($product_type) 
     *
     * @return array
     */
    public static function getItemTypesArray(): array
    {
        return [
            self::PRODUCT_TYPE_PRODUCT => Yii::t('app', 'PRODUCT_TYPE_PRODUCT'),
            self::PRODUCT_TYPE_ACCESSORY => Yii::t('app', 'PRODUCT_TYPE_ACCESSORY'),
        ];
    }
    
    /**
     * Массив соответствий возможных значений item_type дочерним классам
     *
     * @return array
     */
    public static function getItemTypeChilds(): array
    {
        return [
            'backend\modules\catalog\models\abstracts\ProductAttribute' => self::PRODUCT_TYPE_PRODUCT,
            'backend\modules\catalog\models\abstracts\ProductItem' => self::PRODUCT_TYPE_PRODUCT,
            'backend\modules\catalog\models\abstracts\ProductAccessory' => self::PRODUCT_TYPE_ACCESSORY,
        ];
    }
}