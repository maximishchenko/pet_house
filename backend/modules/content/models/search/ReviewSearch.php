<?php

namespace backend\modules\content\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\Review;
use common\models\Sort;

/**
 * ReviewSearch represents the model behind the search form of `backend\modules\content\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_favorite', 'sort', 'created_at'], 'integer'],
            [['name', 'image', 'status', 'text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Review::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> Sort::setDefaultGridSort(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_favorite' => $this->is_favorite,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
