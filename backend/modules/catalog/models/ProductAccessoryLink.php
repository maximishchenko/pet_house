<?php

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\abstracts\ProductItem;
use backend\modules\catalog\models\root\Product;
use Yii;

/**
 * This is the model class for table "{{%product_accessory}}".
 *
 * @property int $product_id
 * @property int $accessory_id
 * @property string $product_type
 * @property string $count
 */
class ProductAccessoryLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_accessory}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'accessory_id', 'product_type'], 'required'],
            [['product_id', 'accessory_id'], 'integer'],
            [['product_type', 'count'], 'string', 'max' => 255],
            [['product_id', 'accessory_id'], 'unique', 'targetAttribute' => ['product_id', 'accessory_id']],
            [['count'], 'default', 'value'=> 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'accessory_id' => Yii::t('app', 'Accessory Name'),
            'product_type' => Yii::t('app', 'Product Type'),
            'count' => Yii::t('app', 'Count Product Accessories'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\ProductAccessoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\ProductAccessoryQuery(get_called_class());
    }
    

    public function getAccessory()
    {
        return $this->hasOne(Product::className(), ['id' => 'accessory_id']);
    }
}
