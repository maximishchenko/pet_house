<?php

namespace backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $comment
 * @property string|null $delivery_type
 * @property string|null $delivery_address
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'body', 'delivery_address'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'delivery_type'], 'string', 'max' => 255],
            [['total_price'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Order Name'),
            'phone' => Yii::t('app', 'Order Phone'),
            'email' => Yii::t('app', 'Order Email'),
            'comment' => Yii::t('app', 'Order Comment'),
            'body' => Yii::t('app', 'Order Body'),
            'delivery_type' => Yii::t('app', 'Delivery Type'),
            'delivery_address' => Yii::t('app', 'Delivery Address'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\OrdeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\OrdeQuery(get_called_class());
    }
}
