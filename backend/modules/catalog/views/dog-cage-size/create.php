<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageSize */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-cage-size-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
