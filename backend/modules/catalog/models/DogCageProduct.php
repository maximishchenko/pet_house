<?php

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\abstracts\ProductItem;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

class DogCageProduct extends ProductItem
{
    public $width;
    public $height;
    public $depth;
    public $min_width;
    public $min_height;
    public $min_depth;
    public $max_width;
    public $max_height;
    public $max_depth;
    public $step;

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), $this->setAttributeLabels());
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), $this->setRules());
    }

    public function setAttributeLabels(): array
    {
        return [
            'imageFile' => Yii::t('app', 'Image'),
            'imagesFiles' => Yii::t('app', 'Images Files'),
            'width' => Yii::t('app', 'Width value'),
            'height' => Yii::t('app', 'Height value'),
            'depth' => Yii::t('app', 'Depth value'),
            'min_width' => Yii::t('app', 'Width value min'),
            'min_height' => Yii::t('app', 'Height value min'),
            'min_depth' => Yii::t('app', 'Depth value min'),
            'max_width' => Yii::t('app', 'Width value max'),
            'max_height' => Yii::t('app', 'Height value max'),
            'max_depth' => Yii::t('app', 'Depth value max'),
            'step' => Yii::t('app', 'Step value'),
        ];
    }

    public function setRules(): array
    {
        return [
            [['width', 'height', 'depth', 'min_width', 'min_height', 'min_depth', 'max_width', 'max_height', 'max_depth', 'step'], 'required'],
            [['width', 'height', 'depth', 'min_width', 'min_height', 'min_depth', 'max_width', 'max_height', 'max_depth', 'step'], 'safe'],
        ];
    }

    public function afterFind()
    {
        $this->width = $this->size->width_value;
        $this->height = $this->size->height_value;
        $this->depth = $this->size->depth_value;
        $this->min_width = $this->size->min_width;
        $this->min_height = $this->size->min_height;
        $this->min_depth = $this->size->min_depth;
        $this->max_width = $this->size->max_width;
        $this->max_height = $this->size->max_height;
        $this->max_depth = $this->size->max_depth;
        $this->height_price = $this->size->height_price;
        $this->width_price = $this->size->width_price;
        $this->depth_price = $this->size->depth_price;
        $this->step = $this->size->step;
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->validate()) {
                if ($insert) {
                    Yii::debug("new");
                    $size = new DogCageSize();
                } else {
                    Yii::debug("Exists");
                    $size = DogCageSize::find()->where(['id' => $this->size_id])->one();
                }
                if ($this->isSizeValueChanged()) {
                    $size->height = $this->height;
                    $size->width = $this->width;
                    $size->depth = $this->depth;
                    $size->min_height = $this->min_height;
                    $size->min_width = $this->min_width;
                    $size->min_depth = $this->min_depth;
                    $size->max_height = $this->max_height;
                    $size->max_width = $this->max_width;
                    $size->max_depth = $this->max_depth;
                    $size->height_price = $this->height_price;
                    $size->width_price = $this->width_price;
                    $size->depth_price = $this->depth_price;
                    $size->step = $this->step;
                    $size->status = (string) Status::STATUS_ACTIVE;
                    if (!$size->save()) {
                        foreach ($size->getErrors() as $key => $value) {
                            Yii::debug($key.': '.$value[0]);
                        }
                        return false;
                    }
                    $this->size_id = $size->id;
                }

                parent::beforeSave($insert);
            } else {
                foreach ($this->getErrors() as $key => $value) {
                    Yii::debug($key.': '.$value[0]);
                }
            }
            
            return true;
        }
        return false;
    }

    private function isSizeValueChanged(): bool
    {
        return $this->size->height_value != $this->height || $this->size->width_value != $this->width || $this->size->depth_value != $this->depth || $this->size->height_price != $this->height_price || $this->size->height_price != $this->height_price || $this->size->depth_price != $this->depth_price;
    }
}
