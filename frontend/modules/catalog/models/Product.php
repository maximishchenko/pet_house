<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\Product as backendProduct;
use backend\modules\catalog\models\root\Property;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\data\ActiveDataProvider;

class Product extends backendProduct
{

    public $height_value;
    public $nameSort;


    public function rules()
    {
        return [
            [['type_id', 'category_id', 'is_available', 'height_value', 'group_id'], 'safe'],
        ];
    }


    public function isCheckboxSearchParamSelected(string $parameterName, string $value)
    {
        $queryParams = Yii::$app->request->queryParams;
        if (isset($queryParams) && isset($queryParams[$parameterName]) && ($queryParams[$parameterName] == $value || in_array($value, $queryParams[$parameterName]))) {
            return "checked";
        }
        return null;
    }

    public function isRadioSearchParamSelected(string $parameterName, string $value)
    {
        $queryParams = Yii::$app->request->queryParams;
        if (isset($queryParams) && isset($queryParams[$parameterName]) && $queryParams[$parameterName] == $value) {
            return "checked";
        }
        return null;
    }

    public function isAvailableActive()
    {
        return (isset(Yii::$app->request->queryParams['is_available']) && Yii::$app->request->queryParams['is_available'] == 1) ? 'disabled' : null;
    }

    public function isAvailableChecked()
    {
        return (isset(Yii::$app->request->queryParams['is_available']) && Yii::$app->request->queryParams['is_available'] == 1) ? 'checked' : null;
    }

    public function isCategoryActive($id)
    {
        $queryParams = Yii::$app->request->queryParams;
        return (isset($queryParams['category_id']) && in_array($id, $queryParams['category_id'])) ? 'disabled' : null;
    }

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
        $query->joinWith(['heights']);
        // $query->product_type = $productType;
        // $query->item_type = $itemType;
        
        $query->where([
            self::tableName().'.product_type' => $productType,
            self::tableName().'.item_type' => $itemType,
            self::tableName().'.status' => Status::STATUS_ACTIVE
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         Property::tableName().'.sort' => SORT_DESC,
            //         'name' => SORT_DESC
            //     ],
            // ],
            // 'sort'=> Sort::setDefaultGridSort(),
        ]);

        
        $dataProvider->setSort([
            'sortParam' => Sort::DEFAULT_SORT_PARAM,
            'attributes' => [
                'name',
                'price',
                'view_count',
                'nameSort' => [
                    'asc' => [Property::tableName().'.sort' => SORT_ASC, 'name' => SORT_ASC],
                    'desc' => [Property::tableName().'.sort' => SORT_DESC, 'name' => SORT_DESC],
                    'default' => SORT_ASC
                ],

            ],
            // 'defaultOrder' => [
            //     Property::tableName().'.sort' => SORT_DESC,
            //     'name' => SORT_DESC
            // ],
            'defaultOrder' => [Property::tableName().'.sort' => SORT_ASC, 'name' => SORT_ASC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if (isset($this->is_available) && !empty($this->is_available) && $this->is_available == 1):
            $query->andFilterWhere([
                'is_available' => $this->is_available,
            ]);
        endif; 
        if (isset($this->category_id) && !empty(array_filter($this->category_id))):
            $query->andFilterWhere([
                'category_id' => $this->category_id,
            ]);
        endif;

        if (isset($this->group_id) && !empty(array_filter($this->group_id))):
            $query->andFilterWhere([
                'group_id' => $this->group_id,
            ]);
        endif;

        if (isset($this->type_id) && !empty(array_filter($this->type_id))):
            $query->andFilterWhere([
                'type_id' => $this->type_id,
            ]);
        endif;

        if (isset($this->height_value) && !empty($this->height_value)):
            $query->andFilterWhere([
                Property::tableName().'.height_value' => $this->height_value,
            ]);
        endif;

        return $dataProvider;
    }
    
    public function formName() {
        return '';
    }
}