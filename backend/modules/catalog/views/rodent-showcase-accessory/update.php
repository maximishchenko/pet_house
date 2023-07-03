<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update Rodent Accessory: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Accessory'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
