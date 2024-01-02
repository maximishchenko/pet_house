<?php

namespace backend\modules\content\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\content\models\Slider]].
 *
 * @see \backend\modules\content\models\Slider
 */
class SliderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\Slider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\Slider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
