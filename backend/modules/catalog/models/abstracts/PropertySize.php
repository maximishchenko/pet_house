<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\root\Property;
use backend\traits\SizeTrait;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Описывает модели, реализующие размеры
 */
// abstract 
 class PropertySize extends Property
{
    use SizeTrait;

    public $width;

    public $height;

    public $depth;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $parent = parent::rules();
        unset($parent['name']);
        unset($parent['imageFile']);
        $rule = [
            [['width', 'height', 'depth'], 'required'],
            [['width_value', 'height_value', 'depth_value', 'width_price', 'height_price', 'depth_price'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg'],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }

    /**
     * Возвращает метки аттрибутов размеров
     *
     * @return array
     */
    public function setAttributeLabels(): array
    {
        return [
            'name' => Yii::t('app', "Size Name"),
            'height' => Yii::t('app', "Size Height"),
            'width' => Yii::t('app', "Size Width"),
            'depth' => Yii::t('app', "Size Depth"),
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), $this->setAttributeLabels());
    }

    public function afterFind()
    {
        $this->width = $this->getSizeValue('width');
        $this->height = $this->getSizeValue('height');
        $this->depth = $this->getSizeValue('depth');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->validate()) {
                $this->height_value = $this->height;
                $this->width_value = $this->width;
                $this->depth_value = $this->depth;
                $this->name = $this->setName();
            } else {
                foreach ($this->getErrors() as $key => $value) {
                    Yii::debug($key.': '.$value[0]);
                }
            }
            return true;
        }
        return false;
    }
}