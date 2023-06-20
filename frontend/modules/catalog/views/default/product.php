<?php

$this->title = "Карточка товара";
$this->params['breadcrumbs'][] = ['label' => "Шиншиллы", 'url' => ['catalog/category/Шиншиллы'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = ['label' => "Витрины для шиншилл, дегу", 'url' => ['catalog/category/Шиншиллы/Витрины_для_шиншилл'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-mob"></div>
<div class="container">
  <section class="product">
    <div class="product__col">

      <!-- Галлерея -->
      <?= $this->render('//layouts/product/_gallery', ['model' => $model]); ?>
      <div class="product__optional">
        <!-- Аксессуары -->
        <?= $this->render('//layouts/product/_accessories', []); ?>
        <!-- Промо -->
        <?= $this->render('//layouts/product/_promo', ['model' => $model]); ?>
        <!-- Отзывы -->
        <?= $this->render('//layouts/template/_faq', []); ?>
        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/product/_review', []); ?>
      </div>
    </div>
    <!-- Конструктор -->
    <?= $this->render('//layouts/product/_sidebar', ['model' => $model]); ?>
  </section>
</div>

<!-- Хиты продаж -->
<?= $this->render('//layouts/_top_sales', ['title' => "Хиты продаж", 'model' => $model]); ?>


<!-- Подписаться -->
<?php $this->beginBlock('subscribe'); ?>
<?= $this->render('//layouts/template/_subscribe', []); ?>
<?php $this->endBlock(); ?>

<!-- Вопросы и ответы -->
<?php $this->beginBlock('faq_bottom'); ?>
<?= $this->render('//layouts/product/_faq_bottom', []); ?>
<?php $this->endBlock(); ?>
