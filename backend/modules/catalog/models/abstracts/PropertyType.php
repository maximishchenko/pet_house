<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\root\Property;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Типы продукта
 */
abstract class PropertyType extends Property
{
    protected $sizesArray;

    public function setAttributeLabels(): array
    {
        return [
            'sizesArray' => Yii::t('app', 'Sizes Array'),
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
            [['sizesArray'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg'],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }
    
    // Размеры

    public function getSizeCheckboxListItems()
    {
        return Property::find()
                    ->where([
                        'property_type' => $this->property_type,
                        'item_type' => PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE,
                    ])
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column();
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizes()
    {
        return $this->hasMany(Property::className(), ['id' => 'target_id'])
                    ->viaTable('{{%property_link}}', ['source_id' => 'id'], function ($query) {
                        /* @var $query \yii\db\ActiveQuery */
                        $query->andWhere([
                            'item_type' => $this->item_type,
                            'property_type' => $this->property_type,
                        ]);
                    });
    }

    public function getSizesArray()
    {
        if ($this->sizesArray === null) {
            $this->sizesArray = $this->getSizes()->select('id')->column();
        } 
        return $this->sizesArray;
    }

    public function setSizesArray($value)
    {
        $this->sizesArray = (array)$value;
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        $this->updateSizes();
    
        parent::afterSave($insert, $changedAttributes);
    }
    
    protected function updateSizes()
    {
        $currentSizeIds = $this->getSizes()->select('id')->column();
        $newSizeIds = $this->getSizesArray();
        if (is_string($newSizeIds)) {
            $newSizeIds = [];
        }

        if (is_array($newSizeIds)) {
            foreach (array_filter(array_diff($newSizeIds, $currentSizeIds)) as $sizeId) {
                /** @var Property $size */
                if ($size = Property::findOne($sizeId)) {
                    $this->link('sizes', $size, [
                        'item_type' => $this->item_type,
                        'property_type' => $this->property_type,
                    ]);
                }
            }
        }

        if (is_array($newSizeIds)) {
            foreach (array_filter(array_diff($currentSizeIds, $newSizeIds)) as $sizeId) {
                /** @var Property $size */
                if ($size = Property::findOne($sizeId)) {
                    $this->unlink('sizes', $size, true);
                }
            }
        }
    }

}