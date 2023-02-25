<?php

namespace backend\modules\catalog\models\items;

use Yii;

class PropertyItemTypeItems
{
    /**
     * Тип раздела каталога - размеры
     */
    const PROPERTY_ITEM_TYPE_SIZE = 'size';
    
    /**
     * Тип раздела каталога - материалы
     */
    const PROPERTY_ITEM_TYPE_MATERIAL = 'material';

    /**
     * Тип раздела каталога - типы 
     */
    const PROPERTY_ITEM_TYPE_TYPE = 'type';

    /**
     * Тип раздела каталога - гравировки
     */
    const PROPERTY_ITEM_TYPE_ENGRAVING = 'engraving';

    /**
     * Тип раздела каталога - боковые стенки
     */
    const PROPERTY_ITEM_TYPE_WALL = 'wall';

    /**
     * Тип раздела каталога - цвета
     */
    const PROPERTY_ITEM_TYPE_COLOR = 'color';

    public static function getItemTypesArray(): array
    {
        return [
            self::PROPERTY_ITEM_TYPE_SIZE => Yii::t('app', 'PROPERTY_ITEM_TYPE_SIZE'),
            self::PROPERTY_ITEM_TYPE_MATERIAL => Yii::t('app', 'PROPERTY_ITEM_TYPE_MATERIAL'),
            self::PROPERTY_ITEM_TYPE_TYPE => Yii::t('app', 'PROPERTY_ITEM_TYPE_TYPE'),
            self::PROPERTY_ITEM_TYPE_ENGRAVING => Yii::t('app', 'PROPERTY_ITEM_TYPE_ENGRAVING'),
            self::PROPERTY_ITEM_TYPE_WALL => Yii::t('app', 'PROPERTY_ITEM_TYPE_WALL'),
            self::PROPERTY_ITEM_TYPE_COLOR => Yii::t('app', 'PROPERTY_ITEM_TYPE_COLOR'),
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
            'backend\modules\catalog\models\abstracts\PropertySize' => self::PROPERTY_ITEM_TYPE_SIZE,
            'backend\modules\catalog\models\abstracts\PropertyMaterial' => self::PROPERTY_ITEM_TYPE_MATERIAL,
            'backend\modules\catalog\models\abstracts\PropertyType' => self::PROPERTY_ITEM_TYPE_TYPE,
            'backend\modules\catalog\models\abstracts\PropertyEngraving' => self::PROPERTY_ITEM_TYPE_ENGRAVING,
            'backend\modules\catalog\models\abstracts\PropertyWall' => self::PROPERTY_ITEM_TYPE_WALL,
            'backend\modules\catalog\models\abstracts\PropertyColor' => self::PROPERTY_ITEM_TYPE_COLOR,
        ];
    }
}