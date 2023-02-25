<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseColor */

$this->title = Yii::t('app', 'Update Rodent Showcase Color: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="rodent-showcase-color-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
