<?php

use backend\modules\catalog\models\root\Product;

if (isset($products) && !empty($products)) : ?>
  <div class="add-accessories">
    <h2 class="section-headline">Вам может подойти</h2>
    <div class="swiper add-accessories__swiper">
      <div class="swiper-wrapper">

        <?php foreach ($products as $product) : ?>
          <div class="swiper-slide">
            <div class="card-accessories">
              <div class="card-accessories__img-wrapper">
                <img class="card-accessories__img" src="<?= '/' . Product::UPLOAD_PATH . $product->image; ?>" alt="">
              </div>
              <div class="card-accessories__text-wrapper">
                <span class="card-accessories__price">
                  <?= Yii::$app->formatter->asCurrency($product->price, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
                </span>
                <a href="#">
                  <h3 class="card-accessories__name">
                    <?= $product->name; ?>
                  </h3>
                </a>
                <button class="btn-reset card-accessories__btn" type="button" data-product-id="<?= $product->id ?>" data-product-price="<?= $product->price; ?>">В корзину</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <div class="swiper-button-prev add-accessories__btn-prev"></div>
      <div class="swiper-button-next add-accessories__btn-next"></div>
    </div>
  </div>
  </div>
<?php endif; ?>