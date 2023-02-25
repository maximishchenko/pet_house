<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageWall */

$this->title = Yii::t('app', 'Update Dog Cage Wall: {name}', [
    'name' => strip_tags($model->name),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Walls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = strip_tags($model->name);
?>
<div class="dog-cage-wall-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
