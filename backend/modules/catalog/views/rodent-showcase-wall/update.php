<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseWall */

$this->title = Yii::t('app', 'Update Rodent Showcase Wall: {name}', [
    'name' => strip_tags($model->name),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Walls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = strip_tags($model->name);
?>
<div class="rodent-showcase-wall-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
