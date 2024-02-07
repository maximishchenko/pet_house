<?php

use backend\modules\content\models\Review;
use yii\helpers\Html;

?>

<div class="reviews-products">
  <a class="reviews-products__link" href="<?= '/' . Review::UPLOAD_PATH . $model->image; ?>" data-fancybox="reviews-gallery">
    <?= Html::img('/' . Review::UPLOAD_PATH . $model->image, ['class' => "reviews-products__img", 'width' => 300]); ?>
  </a>
  <span class="reviews-products__autor">
    <?= $model->name; ?>
  </span>
  <p class="reviews-products__text">
    <?= $model->text; ?>
  </p>
  <span class="reviews-products__date">
    <?= Yii::$app->formatter->asDate(strtotime($model->created_at)); ?>
  </span>
</div>
