<?php

use backend\modules\seo\models\Script;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Core;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\seo\models\ScriptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Scripts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SEO_MODULE'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="script-index">

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
            [
                'class' => SetColumn::className(),
                'filter' => Script::getScriptPositionsArray(),
                'attribute' => 'position',
                'name' => function($data) {
                    return ArrayHelper::getValue(Script::getScriptPositionsArray(), $data->position);
                },
                'contentOptions' => ['style' => 'width:200px;'],
                'cssCLasses' => [
                    Script::BEFORE_END_HEAD => 'success',
                    Script::AFTER_BEGIN_BODY => 'info',
                    Script::BEFORE_END_BODY => 'warning',
                ],
            ],
            [
                'attribute' => 'sort',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            [
                'class' => SetColumn::className(),
                'filter' => Core::getStatusesArray(),
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(Core::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    Core::STATUS_ACTIVE => 'success',
                    Core::STATUS_BLOCKED => 'danger',
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:80px;'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
</div>
