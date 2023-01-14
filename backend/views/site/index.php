<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'DASHBOARD');
?>
<div class="site-index">
    
    <?= $this->render('//layouts/dashboard/_management_dashboard_items'); ?>
    
    <?= $this->render('//layouts/dashboard/_seo_dashboard_items'); ?>
</div>
