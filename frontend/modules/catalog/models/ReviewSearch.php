<?php

namespace frontend\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\Review\search\ReviewSearch as backendReviewSearch;
use backend\modules\content\models\Review;
use common\models\Sort;
use common\models\Status;

class ReviewSearch extends Review
{
    public function search($params)
    {
        $query = Review::find()->where(['status' => Status::STATUS_ACTIVE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }
}
