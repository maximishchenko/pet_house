<?php

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $sections->getProductSectionName($model->product_type), 'url' => [$sections->getProductSectionUrl($model->product_type)], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = $this->title;

// echo "<pre>";
// print_r($model->getAvailableProductSizes());
// echo "</pre>";
?>
<div class="gallery-mob"></div>
<div class="container">
  <section class="product">
    <div class="product__col">

      <!-- Галлерея -->
      <?= $this->render('//layouts/product/_gallery', ['model' => $model]); ?>
      <div class="product__optional">
        <!-- Аксессуары -->
        <?= $this->render('//layouts/product/_accessories', ['accessories' => $accessories]); ?>
        <!-- Промо -->
        <?= $this->render('//layouts/product/_promo', ['model' => $model]); ?>
        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/template/_faq', ['questions' => $questions]); ?>
        <!-- Отзывы -->
        <?= $this->render('//layouts/product/_review', ['reviews' => $reviews]); ?>
      </div>
    </div>
    <!-- Конструктор -->
    <?= $this->render('//layouts/product/_sidebar', ['model' => $model]); ?>
  </section>
</div>



<!-- Подписаться -->
<?php $this->beginBlock('subscribe'); ?>
<?= $this->render('//layouts/template/_subscribe', []); ?>
<?php $this->endBlock(); ?>

<!-- Вопросы и ответы -->
<?php $this->beginBlock('faq_bottom'); ?>
<?= $this->render('//layouts/product/_faq_bottom', []); ?>
<?php $this->endBlock(); ?>

<?= $this->render('//layouts/product/_modal/_cart_modal'); ?>