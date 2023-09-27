<?php

namespace frontend\modules\cart\models;

use backend\modules\catalog\models\Order as backendOrder;

class Order extends backendOrder
{
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['email'], 'email'],
        ];
    }
}