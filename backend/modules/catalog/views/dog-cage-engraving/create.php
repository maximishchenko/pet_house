<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageEngraving */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dog Cage Engravings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-cage-engraving-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
