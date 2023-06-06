<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Information */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
