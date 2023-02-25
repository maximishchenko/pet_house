<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseAttribute */

$this->title = Yii::t('app', 'Update Rodent Showcase Attribute: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="rodent-showcase-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
