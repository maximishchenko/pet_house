<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseEngraving */

$this->title = Yii::t('app', 'Update Rodent Showcase Engraving: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Engravings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="rodent-showcase-engraving-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
