<?php

namespace backend\traits;

use Yii;

trait SizeTrait
{
    /**
     * Задает название размера изделия
     * Формат: высота х ширина х глубина 
     *
     * @return string
     */
    public function setName(): string
    {
        return $this->height . "x" . $this->width . "x" . $this->depth;
    }

    public function getSizeValue(string $type)
    {
        $sizesArray = $this->getSizesArray();
        $sizesTypes = [
            'height' => $sizesArray[0],
            'width' => $sizesArray[1],
            'depth' => $sizesArray[2],
        ];
        if (in_array($type, array_keys($sizesTypes))) {
            return $sizesTypes[$type];
        } else {
            throw new \Exception(Yii::t('app', 'Incorrect size type'));
        }
    }

    private function getSizesArray()
    {
        return explode("x", $this->name);
    }
}