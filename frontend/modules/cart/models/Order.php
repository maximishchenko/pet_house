<?php

namespace frontend\modules\cart\models;

use backend\modules\catalog\models\Order as backendOrder;

class Order extends backendOrder
{
    public $spam_check;

    public function rules()
    {
        return [
            [['comment', 'delivery_address'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'delivery_type'], 'string', 'max' => 255],
            [['total_price', 'imagesFiles', 'spam_check'], 'safe'],
        ];
    }
}
