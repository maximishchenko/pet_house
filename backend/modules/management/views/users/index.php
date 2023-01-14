<?php

use backend\modules\management\models\User;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use hail812\adminlte3\yii\grid\ActionColumn as GridActionColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\management\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

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
                'attribute' => 'fullName',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => array(
                    'class' => 'sort-numerical',
                ),
            ],
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'class' => SetColumn::className(),
                'filter' => User::getRolesArray(),
                'attribute' => 'role',
                'name' => function($data) {
                    return ArrayHelper::getValue(User::getRolesArray(), $data->role);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    User::ROLE_ADMIN => 'success',
                    User::ROLE_DEV => 'danger',
                ],
            ],
            [
                'class' => SetColumn::className(),
                'filter' => User::getStatusesArray(),
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(User::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    User::STATUS_ACTIVE => 'success',
                    User::STATUS_INACTIVE => 'danger',
                ],
            ],
            //'created_at',
            //'updated_at',
            //'verification_token',
            // 'name',
            // 'surname',
            // 'role',

            [
                'class' => GridActionColumn::className(),
                'contentOptions' => ['style' => 'width:80px;'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
