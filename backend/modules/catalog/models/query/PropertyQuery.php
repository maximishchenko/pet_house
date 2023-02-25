<?php

namespace backend\modules\catalog\models\query;

/**
 * This is the ActiveQuery class for [[Property]].
 *
 * @see Property
 */
class PropertyQuery extends \yii\db\ActiveQuery
{
    public $property_type;
    
    public $item_type;

    public function prepare($builder)
    {
        if ($this->property_type !== null) {
            $this->andWhere(['property_type' => $this->property_type]);
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
     * @return Property[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Property|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
