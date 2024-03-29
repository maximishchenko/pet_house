<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\ProductImage;
use backend\modules\catalog\models\root\Attribute;
use backend\modules\catalog\models\root\Product;
use backend\traits\fileTrait;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Аксессуары
 */
// abstract class ProductAccessory extends Product
class ProductAccessory extends Product
{   

    use fileTrait;
    
    public $imageFile;
    public $imagesFiles;
    protected $productAttributesArray;
   
    public function setAttributeLabels(): array
    {
        return [
            'productAttributesArray' => Yii::t('app', 'Attributes Array'),
            'imagesFiles' => Yii::t('app', 'Images Files'),
            'imageFile' => Yii::t('app', 'Image File'),
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), $this->setAttributeLabels());
    }

    public function rules()
    {
        $parent = parent::rules();
        $rule = [
            [['productAttributesArray', 'imageFile', 'imagesFiles'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['imagesFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 20],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }
    
    // Характеристики

    public function getAttributesCheckboxListItems()
    {
        return Attribute::find()
                    ->where([
                        'product_type' => $this->product_type,
                        // 'item_type' => $this->item_type,
                    ])
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column();
    }   

    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])
                    ->viaTable('{{%product_attribute_link}}', ['product_id' => 'id'], function ($query) {
                        /* @var $query \yii\db\ActiveQuery */
                        $query->andWhere([
                            // 'item_type' => $this->item_type,
                            'product_type' => $this->product_type,
                        ]);
                    });
    }

    public function getProductAttributesArray()
    {
        if ($this->productAttributesArray === null) {
            $this->productAttributesArray = $this->getProductAttributes()->select('id')->column();
        } 
        return $this->productAttributesArray;
    }

    public function setProductAttributesArray($value)
    {
        $this->productAttributesArray = (array)$value;
    }
    
    protected function updateProductAttributes()
    {
        $currentAttributeIds = $this->getProductAttributes()->select('id')->column();
        $newAttributeIds = $this->getProductAttributesArray();
        if (is_string($newAttributeIds)) {
            $newAttributeIds = [];
        }

        if (is_array($newAttributeIds)) {
            foreach (array_filter(array_diff($newAttributeIds, $currentAttributeIds)) as $attributeId) {
                /** @var Attribute $attribute */
                if ($attribute = Attribute::findOne($attributeId)) {
                    $this->link('productAttributes', $attribute, [
                        'item_type' => $this->item_type,
                        'product_type' => $this->product_type,
                    ]);
                }
            }
        }

        if (is_array($newAttributeIds)) {
            foreach (array_filter(array_diff($currentAttributeIds, $newAttributeIds)) as $attributeId) {
                /** @var Attribute $attribute */
                if ($attribute = Attribute::findOne($attributeId)) {
                    $this->unlink('productAttributes', $attribute, true);
                }
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setProductImageAttribute();
        $this->updateProductAttributes();
    
        parent::afterSave($insert, $changedAttributes);
    }

    public function getMaterial()
    {
        return $this->hasOne(PropertyMaterial::className(), ['id' => 'material_id']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, false);
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            
            /**
             * Удаление связанных изображений
             */
            $this->deleteMultipleFiles('imagesFiles', 'image', Product::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }

    protected function setProductImageAttribute()
    {
        $this->imagesFiles = UploadedFile::getInstances($this, 'imagesFiles');
        if(isset($this->imagesFiles) && !empty($this->imagesFiles))
        {
            foreach ($this->imagesFiles as $key=>$img) {
                $imageModel = new ProductImage();
                $imageModel->imageFile = $img;
                $imageModel->product_id = $this->id;
                $imageModel->sort = $key;
                $imageModel->save();
                foreach ($imageModel->getErrors() as $error) {
                    Yii::error($error);
                }
            }
        }
    }
}