<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\seo\models\Script */

$this->title = Yii::t('app', 'Add new Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SEO_MODULE'), 'url' => ['/seo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scripts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="script-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
