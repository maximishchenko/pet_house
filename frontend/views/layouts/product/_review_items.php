<?php

use backend\modules\content\models\Review;
use yii\helpers\Html;

?>

<div class="grid-item">
      <div class="grid-masonry-item__container">
        <a class="product-reviews__link" href="<?= '/' . Review::UPLOAD_PATH . $model->image; ?>" data-fancybox="reviews-gallery">
          <?= Html::img('/' . Review::UPLOAD_PATH . $model->image, ['class' => "product-reviews__img", 'width' => 300]); ?>
        </a>
        <span class="product-reviews__autor">
          <?= $model->name; ?>
        </span>
        <p class="product-reviews__text">
          <?= $model->text; ?>
        </p>
        <span class="product-reviews__date">
          <?= Yii::$app->formatter->asDate(strtotime($model->created_at)); ?>
        </span>
      </div>
    </div>