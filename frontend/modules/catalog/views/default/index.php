<?php

$this->title = $sections->getSectionTitle();
$this->params['breadcrumbs'][] = $sections->getSectionName();

?>
<div class="page-head">
    <div class="container">
        <div class="page-head__wrapper">
            <h1 class="section-headline">
                <?= $this->title; ?>
            </h1>
        </div>
    </div>
</div>

<!-- Фильтры по типам -->
<?= $this->render('_filter_type'); ?>


<!-- Фильтры Категориям -->
<?= $this->render('_filter_category', [
    'categories' => $categories,
    'searchModel' => $searchModel,
]); ?>


<section class="catalog mb-xxl">
    <div class="container">
        <div class="catalog__wrapper">
            <div class="catalog__side">
        
                <!-- Фильтры -->
                <?= $this->render('_filter', [
                        'searchModel' => $searchModel,
                        'types' => $types,
                        'categories' => $categories,
                        'heights' => $heights,
                    ]); ?>

                <!-- Элементы каталога -->
                <div class="catalog__list">
                    <?= Yii::$app->controller->renderPartial('//layouts/product/_productLoopAjax', ['dataProvider' => $dataProvider]); ?>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Подписаться -->
<?= $this->render('//layouts/template/_subscribe'); ?>

<!-- Вопросы и ответы -->
<?= $this->render('//layouts/product/_faq_bottom'); ?>
