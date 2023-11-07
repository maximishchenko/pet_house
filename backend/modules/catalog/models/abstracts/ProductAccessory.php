<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\ProductImage;
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
    
    public $imagesFiles;
   
    public function setAttributeLabels(): array
    {
        return [
            'imagesFiles' => Yii::t('app', 'Images Files'),
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
            [['imagesFiles'], 'safe'],
            [['imagesFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 20],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setProductImageAttribute();
    
        parent::afterSave($insert, $changedAttributes);
    }


    public function getMaterial()
    {
        return $this->hasOne(PropertyMaterial::className(), ['id' => 'material_id']);
    }
    

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            
            /**
             * Удаление связанных изображений
             */
            $this->deleteMultipleFiles('imageFiles', 'image', Product::UPLOAD_PATH);
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