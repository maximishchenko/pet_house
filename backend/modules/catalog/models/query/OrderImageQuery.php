<?php

namespace backend\modules\catalog\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\catalog\models\OrderImage]].
 *
 * @see \backend\modules\catalog\models\OrderImage
 */
class OrderImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\OrderImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\OrderImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
