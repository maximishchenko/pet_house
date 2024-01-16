<?php

namespace backend\modules\catalog\models\abstracts;

use backend\modules\catalog\models\items\GroupTypeItems;
use backend\modules\catalog\models\root\Attribute;
use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\ProductAccessoryLink;
use backend\modules\catalog\models\ProductImage;
use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\root\Property;
use backend\modules\content\models\Information;
use backend\traits\fileTrait;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Товар
 */
abstract class ProductItem extends Product
{   

    use fileTrait;
    
    public $imageFile;
    public $imagesFiles;
    protected $productAttributesArray;
    protected $informationItemsArray;
   
    public function setAttributeLabels(): array
    {
        return [
            'productAttributesArray' => Yii::t('app', 'Attributes Array'),
            'informationItemsArray' => Yii::t('app', 'Информация'),
            'imageFile' => Yii::t('app', 'Image File'),
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
            [['productAttributesArray', 'imageFile', 'imagesFiles', 'informationItemsArray'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['imagesFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 20],
        ];
        $rules = ArrayHelper::merge($parent, $rule);
        return $rules;
    }

    public function getSize()
    {
        return $this->hasOne(PropertySize::className(), ['id' => 'size_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(Category::className(), ['id' => 'group_id'])->onCondition(['group_type' => GroupTypeItems::GROUP_TYPE_GROUP]);
    }

    public function getMaterial()
    {
        return $this->hasOne(PropertyMaterial::className(), ['id' => 'material_id']);
    }

    public function getColor()
    {
        return $this->hasOne(PropertyColor::className(), ['id' => 'color_id']);
    }

    public function getWall()
    {
        return $this->hasOne(PropertyWall::className(), ['id' => 'wall_id']);
    }
    
    public function getColorItems()
    {
        $colors = Property::find()
            ->where([
                'property_type' => $this->product_type,
                'status' => Status::STATUS_ACTIVE,
                'item_type' => PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR
            ])->orderBy(['sort' => SORT_DESC])->all();
        return $colors;
    }

    // Аксессуары
    public function getAccessoriesData()
    {
        return ProductAccessoryLink::find()->where(['product_id' => $this->id]);
    }
    
    
    public function getActiveAccessories()
    {
        return $this
            ->hasMany(ProductAccessory::className(), ['id' => 'accessory_id'])
            ->viaTable(ProductAccessoryLink::tableName(), ['product_id' => 'id'])
            ->onCondition([ProductAccessory::tableName().'.status' => Status::STATUS_ACTIVE])
            ->orderBy([ProductAccessory::tableName().'.sort' => SORT_ASC]);
    }
    
    // Характеристики

    public function getAttributesCheckboxListItems()
    {
        
        $characteristics = Attribute::find([
            'product_type' => $this->product_type,
            'item_type' => $this->item_type,
        ])->all();
        $items = ArrayHelper::map($characteristics,'id','characteristicsDescription');
        return $items;
        // return Attribute::find()
        //             ->where([
        //                 'product_type' => $this->product_type,
        //                 'item_type' => $this->item_type,
        //             ])
        //             ->select(['name', 'id'])
        //             ->indexBy('id')
        //             ->column();
    }   

    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])
                    ->viaTable('{{%product_attribute_link}}', ['product_id' => 'id'], function ($query) {
                        /* @var $query \yii\db\ActiveQuery */
                        $query->andWhere([
                            'item_type' => $this->item_type,
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

    // Информация

    public function getInformationCheckboxListItems()
    {
        return Information::find()
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column();
    }   

    public function getInformations()
    {
        return $this->hasMany(Information::className(), ['id' => 'information_item_id'])
                    ->viaTable('{{%product_information_link}}', ['product_id' => 'id']);
    }

    public function getInformationItemsArray()
    {
        if ($this->informationItemsArray === null) {
            $this->informationItemsArray = $this->getInformations()->select('id')->column();
        } 
        return $this->informationItemsArray;
    }

    public function setgetInformationItemssArray($value)
    {
        $this->informationItemsArray = (array)$value;
    }
    
 
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, false);
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setProductImageAttribute();
        $this->updateProductAttributes();
        $this->updateInformationItems();
    
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            /**
             * Удаление файла изображения
             */
            $this->deleteSingleFile('image', Product::UPLOAD_PATH);
            
            /**
             * Удаление связанных изображений
             */
            if ($this->imagesFiles) {
                $this->deleteMultipleFiles('imageFiles', 'image', Product::UPLOAD_PATH);
            }
            return true;
        } else {
            return false;
        }
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

    
    
    protected function updateInformationItems()
    {
        $currentInfoIds = $this->getInformations()->select('id')->column();
        $newInfoIds = $this->getInformationItemsArray();
        if (is_string($newInfoIds)) {
            $newInfoIds = [];
        }

        if (is_array($newInfoIds)) {
            foreach (array_filter(array_diff($newInfoIds, $currentInfoIds)) as $infoId) {
                /** @var Information $info */
                if ($info = Information::findOne($infoId)) {
                    $this->link('informations', $info);
                }
            }
        }

        if (is_array($newInfoIds)) {
            foreach (array_filter(array_diff($currentInfoIds, $newInfoIds)) as $infoId) {
                /** @var Information $info */
                if ($info = Information::findOne($infoId)) {
                    $this->unlink('informations', $info, true);
                }
            }
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