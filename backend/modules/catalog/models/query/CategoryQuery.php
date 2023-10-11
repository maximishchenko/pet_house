<?php

namespace backend\modules\catalog\models\query;

/**
 * This is the ActiveQuery class for [[Category]].
 *
 * @see Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    public $property_type;
    
    public $item_type;

    public $group_type;

    public function prepare($builder)
    {
        if ($this->property_type !== null) {
            $this->andWhere(['property_type' => $this->property_type]);
        }
        if ($this->item_type !== null) {
            $this->andWhere(['item_type' => $this->item_type]);
        }
        if ($this->group_type !== null) {
            $this->andWhere(['group_type' => $this->group_type]);
        }
        return parent::prepare($builder);
    }
    
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
