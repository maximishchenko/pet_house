<?php

$this->title = Yii::t('app', 'CONTENT_MODULE');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-default-index">
    <?= $this->render('//layouts/dashboard/_content_dashboard_items'); ?>
</div>