<?php

use backend\modules\catalog\models\root\Product;
use frontend\models\Sections;

?>
<?php if ($accessories) : ?>
  <div class="add-accessories">
    <h2 class="product-headline">
      <?= Yii::t('app', 'Accessories Items'); ?>
    </h2>
    <div class="swiper add-accessories__swiper">
      <div class="swiper-wrapper">

        <?php $section = new Sections(); ?>
        <?php foreach ($accessories as $accessory) : ?>
          <div class="swiper-slide">
            <div class="card-accessories">
              <div class="card-accessories__img-wrapper">
                <img class="card-accessories__img" src="/<?= Product::UPLOAD_PATH . $accessory->image; ?>" alt="<?= $accessory->name; ?>">
              </div>
              <div class="card-accessories__text-wrapper">
                <span class="card-accessories__price">
                  <?= Yii::$app->formatter->asCurrency($accessory->price, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
                </span>
                <a href="<?= $section->getProductSectionUrl($accessory->product_type) . "/" . $accessory->slug; ?>">
                  <h3 class="card-accessories__name">
                    <?= $accessory->name; ?>
                  </h3>
                </a>
                <button class="btn-reset card-accessories__btn" type="button" data-product-id="<?= $accessory->id ?>" data-product-price="<?= $accessory->price; ?>">
                  <?= Yii::t('app', 'Move to cart'); ?>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <div class="swiper-button-prev add-accessories__btn-prev"></div>
      <div class="swiper-button-next add-accessories__btn-next"></div>
    </div>
  </div>
<?php endif; ?>