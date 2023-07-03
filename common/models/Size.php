<?php

namespace common\models;

class Size
{

    public static function convertMilimeterToMeter($size): float
    {
        return $size / 100;
    }
}