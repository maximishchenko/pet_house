<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseSize */

$this->title = Yii::t('app', 'Update Rodent Showcase Size: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="rodent-showcase-size-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
