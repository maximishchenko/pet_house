<?php

namespace common\models;

class PriceValue
{
    public static function roundToHundreds($price)
    {
        return ceil($price / 100) * 100;
    }
}