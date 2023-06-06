<?php

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\root\Product;
use backend\traits\fileTrait;
use Yii;

/**
 * This is the model class for table "{{%product_image}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property int|null $sort
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
    use fileTrait;

    public $imageFile;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'sort'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['image', 'imageFile'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'image' => Yii::t('app', 'Image'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", Product::UPLOAD_PATH, true);
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            /**
             * Удаление файла изображения
             */
            $this->deleteSingleFile('image', Product::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }

}
