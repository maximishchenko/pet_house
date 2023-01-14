<?php

namespace common\models;

use Yii;
use yii\base\Model;


class Core extends Model
{
    const DEFAULT_SORT_VALUE = 500;

    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_BLOCKED => Yii::t('app', 'STATUS_BLOCKED'),
        ];
    }
}