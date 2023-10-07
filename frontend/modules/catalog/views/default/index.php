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

<?= $productType; ?>

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
                <div class="catalog__list-wrapper">
                    <div class="catalog__list">
                        <?= Yii::$app->controller->renderPartial('//layouts/product/_productLoopAjax', ['dataProvider' => $dataProvider]); ?>
                    </div>
                    <div class="spinner-container mt-xxl">
                        <div class="spinner"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>




<?php //if ($dataProvider->getTotalCount() > $dataProvider->pagination->pageCount): 
?>
<div id="showMore" class="visually-hidden" data-page="<?= (int)Yii::$app->request->get('page', 1); ?>" data-page-count="<?= (int)$dataProvider->pagination->pageCount; ?>" data-csrf-token="<?= Yii::$app->request->csrfToken; ?>" data-csrf-param="<?= Yii::$app->request->csrfParam; ?>">Показать ещё</div>
<?php // endif; 
?>

<!-- Подписаться -->
<?= $this->render('//layouts/template/_subscribe'); ?>

<!-- Вопросы и ответы -->
<?= $this->render('//layouts/product/_faq_bottom'); ?>