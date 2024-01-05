<?php

use backend\modules\seo\models\Redirect;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Core;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\seo\models\RedirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Redirects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SEO_MODULE'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-index">

    <div class="container">


    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            // 'source_url:url',
            [
                'class' => LinkColumn::className(),
                'attribute' => 'source_url',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => array(
                    'class' => 'sort-numerical',
                ),
            ],
            'destination_url:url',
            // 'redirect_code',
            [
                'attribute' => 'redirect_code',
                'format' => 'raw',
                'filter' => Redirect::getRedirectCodeArray(),
            ],
            // 'comment:ntext',
            // 'sort',
            [
                'attribute' => 'sort',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            // 'status',
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
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:80px;'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
</div>
