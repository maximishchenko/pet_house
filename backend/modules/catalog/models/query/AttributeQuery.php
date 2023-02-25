<?php

namespace backend\modules\catalog\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\catalog\models\root\Attribute]].
 *
 * @see \backend\modules\catalog\models\root\Attribute
 */
class AttributeQuery extends \yii\db\ActiveQuery
{
    public $product_type;
    
    public $item_type;

    public function prepare($builder)
    {
        if ($this->product_type !== null) {
            $this->andWhere(['product_type' => $this->product_type]);
        }
        if ($this->item_type !== null) {
            $this->andWhere(['item_type' => $this->item_type]);
        }
        return parent::prepare($builder);
    }

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\root\Attribute[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\root\Attribute|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
