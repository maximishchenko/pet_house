<?php

namespace frontend\modules\cart\models;

use backend\modules\catalog\models\Order as backendOrder;

class Order extends backendOrder
{
    public function rules()
    {
        return [
            [['comment', 'delivery_address'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'delivery_type'], 'string', 'max' => 255],
            [['total_price', 'imagesFiles'], 'safe'],
        ];
    }
}
