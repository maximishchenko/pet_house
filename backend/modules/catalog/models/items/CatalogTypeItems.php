<?php

namespace backend\modules\catalog\models\items;

use Yii;

/**
 * Описывает разделы каталога
 */
class CatalogTypeItems
{
    /**
     * Тип - витрины для грызунов
     */
    const PROPERTY_TYPE_RODENT_SHOWCASE = 'rodent_showcase';
    
    /**
     * Тип - клетки собак
     */
    const PROPERTY_TYPE_DOG_CAGE = 'dog_cage';
    

    /**
     * Возвращает массив допустимых типов ($property_type) 
     *
     * @return array
     */
    public static function getCatalogTypesArray(): array
    {
        return [
            self::PROPERTY_TYPE_RODENT_SHOWCASE => Yii::t('app', "PROPERTY_TYPE_RODENT_SHOWCASE"),
            self::PROPERTY_TYPE_DOG_CAGE => Yii::t('app', "PROPERTY_TYPE_DOG_CAGE"),
        ];
    }
}