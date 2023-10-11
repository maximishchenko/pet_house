<?php

namespace backend\modules\catalog\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\DogCageGroup;
use common\models\Sort;

class DogCageGroupSearch extends DogCageGroup
{
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'image', 'font_color', 'text_color', 'badge_color', 'comment', 'description', 'property_type', 'item_type', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DogCageGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> Sort::setDefaultGridSort(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'font_color', $this->font_color])
            ->andFilterWhere(['like', 'text_color', $this->text_color])
            ->andFilterWhere(['like', 'badge_color', $this->badge_color])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'property_type', $this->property_type])
            ->andFilterWhere(['like', 'item_type', $this->item_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
