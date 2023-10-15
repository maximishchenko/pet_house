<?php

$this->title = Yii::t('app', 'Update Dog Product: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
