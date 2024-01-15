<?php

use backend\modules\catalog\models\root\Product;
use yii\helpers\Url;

?>
<a href="<?= Url::toRoute($model->getSectionUrl() . '/' . $model->slug); ?>" class="thumb-prod">
  <div class="thumb-prod__img-wrapper">
    <div class="thumb-prod__bage-wrapper">
      <?php if($model->group_id): ?>
      <span class="thumb-prod__bage thumb-prod__bage--stock">
        <?= $model->group->name; ?>
      </span>
      <?php endif; ?>
      <?php if($model->discount): ?>
      <span class="thumb-prod__bage thumb-prod__bage--sale">
        <?= $model->discount . "%"; ?>
      </span>
      <?php endif; ?>
    </div>
    <div class="thumb-prod__type-wrapper">
      <?php if($model->is_available): ?>
      <span class="thumb-prod__bage thumb-prod__bage--type">
        <?= Yii::t('app', 'In available'); ?>
      </span>
      <?php endif; ?>
    </div>
    <img class="thumb-prod__img" src="<?= "/" . Product::UPLOAD_PATH . $model->image . "?v=" . $model->updated_at; ?>" alt="<?= $model->name; ?>">
  </div>
  <div class="thumb-prod__info">
    <span class="thumb-prod__price">
      <?= Yii::$app->formatter->asCurrency($model->price); ?>
      <?php // echo Yii::$app->formatter->asCurrency($model->price, 'RUB', [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
      <span class="thumb-prod__price-old">
        <?= Yii::$app->formatter->asCurrency($model->oldPrice); ?>
        <?php // echo Yii::$app->formatter->asCurrency($model->oldPrice, 'RUB', [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
      </span>
    </span>
    <h3 class="thumb-prod__title">
      <?= $model->name; ?>
    </h3>
    <span class="thumb-prod__desc">
      <?php if(isset($model->size->id) && !empty($model->size->id)): ?>
      <?= Yii::t('app', 'Height {height} Width {width} Depth {depth} mm', ['height' => $model->size->height, 'width' => $model->size->width, 'depth' => $model->size->depth]); ?>,
      <?php endif; ?>
      <?= $model->material->name; ?>
    </span>
  </div>
</a>