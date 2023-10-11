<?php

namespace backend\modules\catalog\models\items;

use Yii;

/**
 * Описывает разделы каталога
 */
class GroupTypeItems
{
    /**
     * Тип - группа
     */
    const GROUP_TYPE_GROUP = 'group';
    
    /**
     * Тип - Категория
     */
    const GROUP_TYPE_CATEGORY = 'category';
    

    /**
     * Возвращает массив допустимых типов ($group_type) 
     *
     * @return array
     */
    public static function getCatalogTypesArray(): array
    {
        return [
            self::GROUP_TYPE_GROUP => Yii::t('app', "GROUP_TYPE_GROUP"),
            self::GROUP_TYPE_CATEGORY => Yii::t('app', "GROUP_TYPE_CATEGORY"),
        ];
    }
}