<?php

use backend\modules\catalog\models\items\ProductItemType;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $sections->getProductSectionName($model->product_type), 'url' => [$sections->getProductSectionUrl($model->product_type)], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-mob"></div>
<div class="container">
  <section class="product">
    <div class="product__col">

      <!-- Галлерея -->
      <?= $this->render('//layouts/product/_gallery', ['model' => $model]); ?>
      <div class="product__optional">
        <?php if($model->item_type != ProductItemType::PRODUCT_TYPE_ACCESSORY): ?>
          <div class="mob-adapt-calc"></div>
        <!-- Аксессуары -->
          <?= $this->render('//layouts/product/_accessories', ['accessories' => $accessories]); ?>
        <!-- Промо -->
          <?= $this->render('//layouts/product/_promo', ['model' => $model]); ?>
        <?php endif; ?>
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

<?= $this->render('//layouts/product/_modal/_cart_modal', ['accessories' => $accessories]); ?>