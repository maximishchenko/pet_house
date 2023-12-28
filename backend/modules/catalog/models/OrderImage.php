<?php

namespace backend\modules\catalog\models;

use backend\traits\fileTrait;
use Yii;

/**
 * This is the model class for table "{{%order_image}}".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $image
 */
class OrderImage extends \yii\db\ActiveRecord
{
    use fileTrait;

    public $imageFile;
    

    const UPLOAD_PATH = 'uploads/order_image/';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['image', 'imageFile'], 'safe'],
            // [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\OrderImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\OrderImageQuery(get_called_class());
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, true);
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
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
