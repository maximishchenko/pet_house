<?php

use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\search\InformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Informations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-index">

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
            'sort',
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
