<?php

namespace common\models;

use Yii;

/**
 * Управление параметрами сортироки элементов каталога
 */
class Sort
{
    const DEFAULT_SORT_VALUE = 500;

    /**
     * Параметр сортировки по-умолчанию
     */
    const DEFAULT_SORT_PARAM = 'order';

    /**
     * Значение параметра сортировки по умолнчанию
     */
    const BASE_SORT_VALUE = 'name';

    /**
     * CSS-класс пункта виджера сортировки по умолчанию
     */
    const DEFAULT_WIDGET_ITEM_CLASS = "btn-reset catalog-bar__sort-item sort__item";

    /**
     * CSS-класс Активного пункта виджера сортаровки
     */
    const ACTIVE_WIDGET_ITEM_CLASS = "catalog-bar__sort-item--active";

    /**
     * Возвращает массив параметров сотировки GridView по-умолчанию
     * Пример использования
     * 
     * ```php
     *   $dataProvider = new ActiveDataProvider([
     *       'query' => $query,
     *       'sort'=> Sort::setDefaultGridSort(),
     *   ]);
     * ```
     *
     * @return array
     */
    public static function setDefaultGridSort(): array
    {
        return [
            'defaultOrder' => [
                'id'=>SORT_DESC,
            ]
        ];
    }

    /**
     * Возвращает массив параметров сортировки
     * Ключ массив - название поля в БД с направлением сортировки, значение - текст виджета
     *
     * @return array
     */
    public static function getCatalogSortItemsArray(): array
    {
        return [
            self::BASE_SORT_VALUE => Yii::t('app', 'Sort by Name'),
            "view_count" => Yii::t('app', 'Sort by Popular'),
            "-price" => Yii::t('app', 'Sort by More Price'),
            "price" => Yii::t('app', 'Sort by Less Price'),
        ];
    }

    /**
     * Возвращает строку текущего аттрибута сортировки
     *
     * @return string
     */
    public static function getCatalogSortAttribute(): string
    {
        return (self::isSortExists()) ? self::getCatalogSortItemsArray()[Yii::$app->request->queryParams[self::DEFAULT_SORT_PARAM]] : Yii::t('app', 'Sort by Name');
    }    

    /**
     * Назначает класс для элемента сортировки
     *
     * @param string $param
     * @return string
     */
    public static function getCatalogSortSelectItemClassName(string $param): string
    {
        return (self::isCatalogSortSelectItemActive($param)) ? self::DEFAULT_WIDGET_ITEM_CLASS . " " . self::ACTIVE_WIDGET_ITEM_CLASS : self::DEFAULT_WIDGET_ITEM_CLASS;
    }

    /**
     * Проверяет активен ли текущий параметр сортировки
     *
     * @param string $param проверяемый параметр сортировки
     * @return boolean
     */
    private static function isCatalogSortSelectItemActive(string $param): bool
    {
        if (self::isSortExists()) {
            return Yii::$app->request->queryParams[self::DEFAULT_SORT_PARAM] == $param;
        } else {
            return $param == self::BASE_SORT_VALUE;
        }
    }

    /**
     * Проверяет наличие параметра сортировки
     *
     * @return boolean
     */
    private static function isSortExists(): bool
    {
        return isset(Yii::$app->request->queryParams[self::DEFAULT_SORT_PARAM]) && 
            !empty(Yii::$app->request->queryParams[self::DEFAULT_SORT_PARAM] && 
            in_array(Yii::$app->request->queryParams[self::DEFAULT_SORT_PARAM], array_keys(self::getCatalogSortItemsArray() )));
    }
}