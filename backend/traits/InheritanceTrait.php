<?php

namespace backend\traits;

trait InheritanceTrait
{    
    /**
     * Возвращает имя дочернего класса без учета пространства имен
     *
     * @return string
     */
    public function getChildClassShortName(): string
    {
        $reflect = new \ReflectionClass($this);
        $cls = $reflect->getShortName();
        return $cls;
    }
}