<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseCategory */

$this->title = Yii::t('app', 'Update Dog Cage Group: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-showcase-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
