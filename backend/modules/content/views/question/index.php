<?php

use backend\modules\content\models\Question;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Questions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">


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
                'attribute' => 'question',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => array(
                    'class' => 'sort-numerical',
                ),
            ],
            'answer:ntext',
            'sort',
            [
                'class' => SetColumn::className(),
                'filter' => Question::getPositionsArray(),
                'attribute' => 'position',
                'name' => function($data) {
                    return ArrayHelper::getValue(Question::getPositionsArray(), $data->position);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    Question::POSITION_BOTTOM => 'info',
                    Question::POSITION_CARD => 'success',
                ],
            ],
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
