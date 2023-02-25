<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageEngraving */

$this->title = Yii::t('app', 'Update Dog Cage Engraving: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Engravings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="dog-cage-engraving-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
