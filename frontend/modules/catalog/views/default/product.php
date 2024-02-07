<?php

use backend\modules\catalog\models\items\ProductItemType;
use yii\helpers\Html;

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
        <?php if ($model->item_type != ProductItemType::PRODUCT_TYPE_ACCESSORY) : ?>
          <div class="mob-adapt-calc"></div>
          <!-- Аксессуары -->
          <?= $this->render('//layouts/product/_accessories', ['accessories' => $accessories]); ?>
          <!-- Промо -->
          <?= $this->render('//layouts/product/_promo', ['model' => $model]); ?>
        <?php endif; ?>
        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/template/_faq', ['questions' => $questions]); ?>
        <!-- Отзывы -->
        <?php // echo $this->render('//layouts/product/_review', ['reviews' => $reviews]); 
        ?>


        <?php if (!empty($reviewsDataProvider)) : ?>
          <div class="product-reviews mt-xxl">
            <h2 class="product-headline">
              <?= Yii::t('app', "Our clients reviews"); ?>
            </h2>
              <div class="reviews-grid">
                <?= Yii::$app->controller->renderPartial('//layouts/product/_reviewLoopAjax', ['reviewsDataProvider' => $reviewsDataProvider]); ?>
              </div>
          </div>
        <?php endif; ?>
      </div>
      <?= Html::button(Yii::t('app', 'Show more reviews'), ['class' => "product-reviews__btn btn-reset btn-b",  'data-page' => (int)Yii::$app->request->get('page', 1), 'data-page-count' => (int)$reviewsDataProvider->pagination->pageCount, 'data-csrf-token' => Yii::$app->request->csrfToken, 'data-csrf-param' => Yii::$app->request->csrfParam]); ?>
    </div>

    <!-- Конструктор -->
    <?= $this->render('//layouts/product/_sidebar', ['model' => $model]); ?>

</div>
</div>
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