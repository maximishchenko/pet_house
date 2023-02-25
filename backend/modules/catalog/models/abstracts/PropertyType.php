<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\root\Property;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Типы продукта
 */
abstract class PropertyType extends Property
{
    public function setAttributeLabels(): array
    {
        return [
            'price' => Yii::t('app', "Type Price"),
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), $this->setAttributeLabels());
    }
    
    public function rules()
    {
        $parent = parent::rules();
        unset($parent['name']);
        unset($parent['imageFile']);
        $rule = [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg'],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }
}