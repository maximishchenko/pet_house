<?php

use backend\modules\content\models\Review;
use yii\helpers\Html;

?>

<?php if(!empty($reviews)): ?>
<div class="product-reviews mt-xxl">
  <h2 class="product-headline">
    <?= Yii::t('app', "Our clients reviews"); ?>
  </h2>
  <div class="grid-masonry" data-masonry='{  "itemSelector": ".grid-item", "gutter": ".gutter-sizer" }'>
    <div class="gutter-sizer"></div>

    <?php foreach($reviews as $review): ?>
    <div class="grid-item">
      <div class="grid-masonry-item__container">
        <a class="product-reviews__link" href="<?= '/' . Review::UPLOAD_PATH . $review->image; ?>" data-fancybox="reviews-gallery">
          <?= Html::img('/' . Review::UPLOAD_PATH . $review->image, ['class' => "product-reviews__img", 'width' => 300]); ?>
        </a>
        <span class="product-reviews__autor">
          <?= $review->name; ?>
        </span>
        <p class="product-reviews__text">
          <?= $review->text; ?>
        </p>
        <span class="product-reviews__date">
          <?= Yii::$app->formatter->asDate($review->created_at); ?>
        </span>
      </div>
    </div>
    <?php endforeach; ?>


  </div>
  <?= Html::button(Yii::t('app', 'Show more reviews'), ['class' => "product-reviews__btn btn-reset btn-b"]); ?>
</div>
<?php endif; ?>

