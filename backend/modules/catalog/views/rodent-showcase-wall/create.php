<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseWall */

$this->title = Yii::t('app', 'Create new record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Showcase Walls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rodent-showcase-wall-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
