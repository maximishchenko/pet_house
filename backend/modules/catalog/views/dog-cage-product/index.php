<?php

use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\catalog\models\RodentProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rodent Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-product-index">

    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'name',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => array(
                    'class' => 'sort-numerical',
                ),
            ],
            // 'slug',
            // 'category_id',
            // 'type_id',
            //'material_id',
            //'color_id',
            //'wall_id',
            //'engraving_id',
            //'size_id',
            //'is_available',
            //'price',
            //'discount',
            //'is_fix_price',
            //'is_constructor_blocked',
            //'comment:ntext',
            //'description:ntext',
            //'view_count',
            //'product_type',
            //'item_type',
            //'sort',
            //'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            'sort',
            'updated_at:datetime',
            'comment:ntext',      
            [
                'class' => SetColumn::className(),
                'filter' => Status::getStatusesArray(),
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(Status::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    Status::STATUS_ACTIVE => 'success',
                    Status::STATUS_BLOCKED => 'danger',
                ],
            ],

            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:100px;'],
                'template' => ' &nbsp; {update} &nbsp; {delete}',
            ],
        ],
    ]); ?>


</div>
