<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageSize */

$this->title = Yii::t('app', 'Update Dog Cage Size: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="dog-cage-size-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
