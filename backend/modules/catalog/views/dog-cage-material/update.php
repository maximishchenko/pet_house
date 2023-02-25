<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageMaterial */

$this->title = Yii::t('app', 'Update Dog Cage Material: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="dog-cage-material-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
