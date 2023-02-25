<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<div class="container">
<?= Breadcrumbs::widget([
    'tag' => 'div',
    'itemTemplate' => "{link}<span class=\"breadcrumbs__space\">/</span>",
    'activeItemTemplate' => "<a class=\"breadcrumbs__link breadcrumbs__link--dis\">{link}</a>",
    'options' => [
        'class' => 'breadcrumbs', 
    ],
    'homeLink' => [
        'label' => Yii::t('app', 'HomeLink'),
        'url' => Url::to(['/']),
        'class' => 'breadcrumbs__link',
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
</div>