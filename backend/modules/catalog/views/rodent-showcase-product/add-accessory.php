<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentProduct */

$this->title = Yii::t('app', 'Add Accessory Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Update Rodent Product: {name}', ['name' => $model->name]), 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-product-create">

    <?= $this->render('_form_accessory', [
        'model' => $model, 
        'accessoryModel' => $accessoryModel
    ]) ?>

</div>