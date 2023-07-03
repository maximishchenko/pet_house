<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\root\Product as backendProduct;
use common\models\Sort;
use common\models\Status;
use yii\data\ActiveDataProvider;

class Product extends backendProduct
{
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $productType, $itemType)
    {
        $query = self::find();
        $query->product_type = $productType;
        $query->item_type = $itemType;
        $query->where([self::tableName().'.status' => Status::STATUS_ACTIVE]);

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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'category_id' => $this->category_id,
        //     'type_id' => $this->type_id,
        //     'material_id' => $this->material_id,
        //     'color_id' => $this->color_id,
        //     'wall_id' => $this->wall_id,
        //     'engraving_id' => $this->engraving_id,
        //     'size_id' => $this->size_id,
        //     'is_available' => $this->is_available,
        //     'price' => $this->price,
        //     'discount' => $this->discount,
        //     'is_fix_price' => $this->is_fix_price,
        //     'is_constructor_blocked' => $this->is_constructor_blocked,
        //     'view_count' => $this->view_count,
        //     'sort' => $this->sort,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'created_by' => $this->created_by,
        //     'updated_by' => $this->updated_by,
        // ]);

        // $query->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'slug', $this->slug])
        //     ->andFilterWhere(['like', 'comment', $this->comment])
        //     ->andFilterWhere(['like', 'description', $this->description])
        //     ->andFilterWhere(['like', 'product_type', $this->product_type])
        //     ->andFilterWhere(['like', 'item_type', $this->item_type])
        //     ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}