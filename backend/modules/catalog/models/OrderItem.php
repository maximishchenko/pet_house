<?php

namespace backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property int $id
 * @property int|null $order_id
 * @property string|null $product_id
 * @property float|null $height
 * @property float|null $width
 * @property float|null $depth
 * @property int|null $wall_id
 * @property int|null $color_id
 *
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'wall_id', 'color_id'], 'integer'],
            [['product_id'], 'string'],
            [['height', 'width', 'depth'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'height' => Yii::t('app', 'Height'),
            'width' => Yii::t('app', 'Width'),
            'depth' => Yii::t('app', 'Depth'),
            'wall_id' => Yii::t('app', 'Wall ID'),
            'color_id' => Yii::t('app', 'Color ID'),
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\catalog\models\query\OrderQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\OrderItemQuery(get_called_class());
    }
}
