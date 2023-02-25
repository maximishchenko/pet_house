<?php

namespace common\models;

class Sort
{
    const DEFAULT_SORT_VALUE = 500;

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
        return ['defaultOrder' => ['id'=>SORT_DESC]];
    }
}