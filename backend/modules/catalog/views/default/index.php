<?php

$this->title = Yii::t('app', 'CATALOG_MODULE');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="management-default-index">
    <?= $this->render('//layouts/dashboard/_catalog_dashboard_items'); ?>
</div>
