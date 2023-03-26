<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Catalogs');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-head">
    <div class="container">
        <div class="page-head__wrapper">
            <h1 class="section-headline">Витрины для грызунов</h1>
        </div>
    </div>
</div>

<!-- Фильтры по типам -->
<?= $this->render('_filter_type'); ?>


<!-- Фильтры Категориям -->
<?= $this->render('_filter_category'); ?>


<section class="catalog mb-xxl">
    <div class="container">
        <div class="catalog__wrapper">
            <div class="catalog__side">
        
                <!-- Фильтры -->
                <?= $this->render('_filter'); ?>

                <!-- Элементы каталога -->
                <?= $this->render("_catalog_items"); ?>

            </div>
        </div>
    </div>
</section>


<!-- Подписаться -->
<?= $this->render('//layouts/template/_subscribe'); ?>

<!-- Вопросы и ответы -->
<?= $this->render('//layouts/template/_faq'); ?>